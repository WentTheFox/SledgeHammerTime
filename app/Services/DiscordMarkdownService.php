<?php

declare(strict_types=1);

namespace App\Services;

class DiscordMarkdownService {
  /**
   * @param string                $source
   * @param array<string, string> $channels
   * @param array<string, string> $users
   * @param array<string, string> $roles
   * @param string|null           $guildId
   *
   * @return string
   */
  public function convert(
    string $source,
    array $channels = [],
    array $users = [],
    array $roles = [],
    ?string $guildId = null
  ): string {
    $linkCache = [];
    $linkCounter = 0;
    $mentionCache = [];
    $mentionCounter = 0;

    // Extract and cache links BEFORE general HTML escaping
    // Named escaped links: [text](<https://example.com>) - must run FIRST before escaped URLs only
    $source = preg_replace_callback(
      '/\[([^]]*)]\(<(https?:\/\/[^>]+)>\)/',
      function (array $m) use (&$linkCache, &$linkCounter) {
        $href = $m[2];
        $linkText = $m[1];
        $placeholder = "\x00LINK" . ($linkCounter++) . "\x00";
        $linkCache[$placeholder] = [
          'href' => $href,
          'text' => $linkText,
          'type' => 'named'
        ];
        return $placeholder;
      },
      $source
    );

    // Escaped URLs only: <https://example.com>
    $source = preg_replace_callback(
      '/<(https?:\/\/[^>]+)>/',
      function (array $m) use (&$linkCache, &$linkCounter) {
        $href = $m[1];
        $display = $m[1];
        $placeholder = "\x00LINK" . ($linkCounter++) . "\x00";
        $linkCache[$placeholder] = [
          'href' => $href,
          'text' => $display,
          'type' => 'escaped'
        ];
        return $placeholder;
      },
      $source
    );

    // Standard links: [text](https://example.com)
    $source = preg_replace_callback(
      '/\[([^]]+)]\((https?:\/\/[^)]+)\)/',
      function (array $m) use (&$linkCache, &$linkCounter) {
        $href = $m[2];
        $linkText = $m[1];
        $placeholder = "\x00LINK" . ($linkCounter++) . "\x00";
        $linkCache[$placeholder] = [
          'href' => $href,
          'text' => $linkText,
          'type' => 'standard'
        ];
        return $placeholder;
      },
      $source
    );

    // Discord mentions: <@USER_ID>, <@!USER_ID>, <#CHANNEL_ID>, <@&ROLE_ID>
    $source = preg_replace_callback(
      '/<(@!?|#|@&)(\d+)>/',
      function (array $m) use (&$mentionCache, &$mentionCounter, $users, $channels, $roles, $guildId) {
        $type = $m[1];
        $id = $m[2];
        $placeholder = "\x00MENTION" . ($mentionCounter++) . "\x00";

        if ($type === '@' || $type === '@!') {
          $name = $users[$id] ?? "User #$id";
          $mentionCache[$placeholder] = [
            'type' => 'user',
            'id' => $id,
            'name' => $name,
            'url' => $guildId ? "https://discord.com/users/$id" : null
          ];
        } elseif ($type === '#') {
          $name = $channels[$id] ?? "Channel #$id";
          $mentionCache[$placeholder] = [
            'type' => 'channel',
            'id' => $id,
            'name' => $name,
            'url' => $guildId ? "https://discord.com/channels/$guildId/$id" : null
          ];
        } elseif ($type === '@&') {
          $name = $roles[$id] ?? "Role #$id";
          $mentionCache[$placeholder] = [
            'type' => 'role',
            'id' => $id,
            'name' => $name,
            'url' => null
          ];
        }

        return $placeholder;
      },
      $source
    );

    // Command mentions: </name:id>
    $source = preg_replace_callback(
      '/<\/([^:]+):(\d+)>/',
      function (array $m) use (&$mentionCache, &$mentionCounter) {
        $name = $m[1];
        $id = $m[2];
        $placeholder = "\x00MENTION" . ($mentionCounter++) . "\x00";

        $mentionCache[$placeholder] = [
          'type' => 'command',
          'id' => $id,
          'name' => $name,
          'url' => "/app#command-$id"
        ];

        return $placeholder;
      },
      $source
    );

    // Extract blockquote lines BEFORE HTML escaping (blockquote syntax uses >)
    $blockquoteCache = [];
    $blockquoteCounter = 0;
    $source = preg_replace_callback(
      '/(?:^>\s+.+$\n?)+/m',
      function (array $m) use (&$blockquoteCache, &$blockquoteCounter) {
        $lines = array_filter(explode("\n", rtrim($m[0])));
        $content = implode("\n", array_map(function($line) {
          return preg_replace('/^>\s+/', '', $line);
        }, $lines));
        $placeholder = "\x00BLOCKQUOTE" . ($blockquoteCounter++) . "\x00";
        $blockquoteCache[$placeholder] = $content;
        return $placeholder;
      },
      $source
    );

    // Extract muted text lines BEFORE HTML escaping (uses -# syntax)
    $mutedCache = [];
    $mutedCounter = 0;
    $source = preg_replace_callback(
      '/^-#\s+(.+)$/m',
      function (array $m) use (&$mutedCache, &$mutedCounter) {
        $placeholder = "\x00MUTED" . ($mutedCounter++) . "\x00";
        $mutedCache[$placeholder] = $m[1];
        return $placeholder;
      },
      $source
    );

    // Escape raw HTML to prevent XSS - only tags we explicitly construct are real HTML
    $text = htmlspecialchars($source, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');

    // Restore blockquotes
    foreach ($blockquoteCache as $placeholder => $content) {
      $text = str_replace($placeholder, '<blockquote>' . htmlspecialchars($content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</blockquote>', $text);
    }

    // Restore muted text
    foreach ($mutedCache as $placeholder => $content) {
      $text = str_replace($placeholder, '<small class="muted">' . htmlspecialchars($content, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') . '</small>', $text);
    }

    // Triple backtick code blocks (must run before inline code)
    $text = preg_replace('/```([\s\S]*?)```/', '<pre><code>$1</code></pre>', $text);

    // Inline code
    $text = preg_replace('/`([^`]+)`/', '<code>$1</code>', $text);

    // Headings - most specific first to avoid partial matches
    $text = preg_replace('/^#{6}\s+(.+)$/m', '<h6>$1</h6>', $text);
    $text = preg_replace('/^#{5}\s+(.+)$/m', '<h5>$1</h5>', $text);
    $text = preg_replace('/^#{4}\s+(.+)$/m', '<h4>$1</h4>', $text);
    $text = preg_replace('/^#{3}\s+(.+)$/m', '<h3>$1</h3>', $text);
    $text = preg_replace('/^#{2}\s+(.+)$/m', '<h2>$1</h2>', $text);
    $text = preg_replace('/^#\s+(.+)$/m', '<h1>$1</h1>', $text);

    // List items, then wrap consecutive <li> in <ul>
    $text = preg_replace('/^[-*]\s+(.+)$/m', '<li>$1</li>', $text);
    $text = preg_replace('/(<li>.*?<\/li>\n?)+/s', '<ul>$0</ul>', $text);

    // Bold italic (*** must precede ** and *)
    $text = preg_replace('/\*{3}(.+?)\*{3}/s', '<strong><em>$1</em></strong>', $text);

    // Bold
    $text = preg_replace('/\*{2}(.+?)\*{2}/s', '<strong>$1</strong>', $text);

    // Italic (single asterisk)
    $text = preg_replace('/\*(.+?)\*/s', '<em>$1</em>', $text);

    // Underline (__ must precede single _ italic to avoid partial consumption)
    $text = preg_replace('/__(.+?)__/s', '<u>$1</u>', $text);

    // Italic (single underscore)
    $text = preg_replace('/_(.+?)_/s', '<em>$1</em>', $text);

    // Strikethrough
    $text = preg_replace('/~~(.+?)~~/s', '<del>$1</del>', $text);

    // Restore links
    foreach ($linkCache as $placeholder => $link) {
      $href = htmlspecialchars($link['href'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
      $displayText = $link['text'];

      // Process markdown formatting in the link text (bold, italic, code, etc.)
      $displayText = htmlspecialchars($displayText, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
      $displayText = preg_replace('/`([^`]+)`/', '<code>$1</code>', $displayText);
      $displayText = preg_replace('/\*{3}(.+?)\*{3}/s', '<strong><em>$1</em></strong>', $displayText);
      $displayText = preg_replace('/\*{2}(.+?)\*{2}/s', '<strong>$1</strong>', $displayText);
      $displayText = preg_replace('/\*(.+?)\*/s', '<em>$1</em>', $displayText);
      $displayText = preg_replace('/__(.+?)__/s', '<u>$1</u>', $displayText);
      $displayText = preg_replace('/_(.+?)_/s', '<em>$1</em>', $displayText);
      $displayText = preg_replace('/~~(.+?)~~/s', '<del>$1</del>', $displayText);

      $html = '<a href="' . $href . '" rel="noopener noreferrer" target="_blank">' . $displayText . '</a>';
      $text = str_replace($placeholder, $html, $text);
    }

    // Restore Discord mentions
    foreach ($mentionCache as $placeholder => $mention) {
      $name = htmlspecialchars($mention['name'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
      $className = 'discord-mention discord-mention--' . $mention['type'];
      $prefix = match ($mention['type']) {
        'command' => '/',
        'channel' => '#',
        default => '@',
      };

      if ($mention['url']) {
        $html = '<a href="' . htmlspecialchars($mention['url'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8') .
                '" class="' . $className . '" rel="noopener noreferrer" target="_blank">' . $prefix . $name . '</a>';
      } else {
        $html = '<span class="' . $className . '">' . $prefix . $name . '</span>';
      }

      $text = str_replace($placeholder, $html, $text);
    }

    // Bare newlines → <br> (skip lines that are already block-level HTML)
    $text = preg_replace('/\n(?!<(?:ul|\/ul|li|h[1-6]|blockquote|pre|\/pre|a|span))/', '<br>', $text);

    return $text;
  }
}
