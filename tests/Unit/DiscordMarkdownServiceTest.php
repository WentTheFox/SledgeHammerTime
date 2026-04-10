<?php

declare(strict_types=1);

use App\Services\DiscordMarkdownService;

// ============================================================================
// Escaped Links (Angle Brackets)
// ============================================================================

test('escaped URL only', function () {
    $service = new DiscordMarkdownService();
    $input = '<https://example.com>';
    $expected = '<a href="https://example.com" rel="noopener noreferrer" target="_blank">https://example.com</a>';
    expect($service->convert($input))->toBe($expected);
});

test('escaped URL with path', function () {
    $service = new DiscordMarkdownService();
    $input = '<https://example.com/path/to/page>';
    $expected = '<a href="https://example.com/path/to/page" rel="noopener noreferrer" target="_blank">https://example.com/path/to/page</a>';
    expect($service->convert($input))->toBe($expected);
});

test('escaped URL with query params', function () {
    $service = new DiscordMarkdownService();
    $input = '<https://example.com/search?q=test&page=1>';
    $expected = '<a href="https://example.com/search?q=test&amp;page=1" rel="noopener noreferrer" target="_blank">https://example.com/search?q=test&amp;page=1</a>';
    expect($service->convert($input))->toBe($expected);
});

test('escaped http URL', function () {
    $service = new DiscordMarkdownService();
    $input = '<http://example.com>';
    $expected = '<a href="http://example.com" rel="noopener noreferrer" target="_blank">http://example.com</a>';
    expect($service->convert($input))->toBe($expected);
});

test('escaped URL multiple in text', function () {
    $service = new DiscordMarkdownService();
    $input = 'Check out <https://example.com> and <https://other.com>';
    $expected = 'Check out <a href="https://example.com" rel="noopener noreferrer" target="_blank">https://example.com</a> and <a href="https://other.com" rel="noopener noreferrer" target="_blank">https://other.com</a>';
    expect($service->convert($input))->toBe($expected);
});

// ============================================================================
// Named Escaped Links (with Angle Brackets in URL)
// ============================================================================

test('named escaped link', function () {
    $service = new DiscordMarkdownService();
    $input = '[Click here](<https://example.com>)';
    $expected = '<a href="https://example.com" rel="noopener noreferrer" target="_blank">Click here</a>';
    expect($service->convert($input))->toBe($expected);
});

test('named escaped link with path', function () {
    $service = new DiscordMarkdownService();
    $input = '[Documentation](<https://example.com/docs>)';
    $expected = '<a href="https://example.com/docs" rel="noopener noreferrer" target="_blank">Documentation</a>';
    expect($service->convert($input))->toBe($expected);
});

test('named escaped link http', function () {
    $service = new DiscordMarkdownService();
    $input = '[Site](<http://example.com>)';
    $expected = '<a href="http://example.com" rel="noopener noreferrer" target="_blank">Site</a>';
    expect($service->convert($input))->toBe($expected);
});

test('named escaped link multiple', function () {
    $service = new DiscordMarkdownService();
    $input = 'Visit [Google](<https://google.com>) and [GitHub](<https://github.com>)';
    $expected = 'Visit <a href="https://google.com" rel="noopener noreferrer" target="_blank">Google</a> and <a href="https://github.com" rel="noopener noreferrer" target="_blank">GitHub</a>';
    expect($service->convert($input))->toBe($expected);
});

// ============================================================================
// Standard Links (Backward Compatibility)
// ============================================================================

test('standard markdown link', function () {
    $service = new DiscordMarkdownService();
    $input = '[Example](https://example.com)';
    $expected = '<a href="https://example.com" rel="noopener noreferrer" target="_blank">Example</a>';
    expect($service->convert($input))->toBe($expected);
});

test('standard link with path', function () {
    $service = new DiscordMarkdownService();
    $input = '[Docs](https://example.com/docs)';
    $expected = '<a href="https://example.com/docs" rel="noopener noreferrer" target="_blank">Docs</a>';
    expect($service->convert($input))->toBe($expected);
});

// ============================================================================
// XSS Prevention
// ============================================================================

test('escaped link rejects javascript', function () {
    $service = new DiscordMarkdownService();
    $input = '<javascript:alert("xss")>';
    $expected = '&lt;javascript:alert(&quot;xss&quot;)&gt;';
    expect($service->convert($input))->toBe($expected);
});

test('standard link rejects javascript', function () {
    $service = new DiscordMarkdownService();
    $input = '[Click](<javascript:alert("xss")>)';
    $expected = '[Click](&lt;javascript:alert(&quot;xss&quot;)&gt;)';
    expect($service->convert($input))->toBe($expected);
});

test('standard link rejects data uri', function () {
    $service = new DiscordMarkdownService();
    $input = '[Click](data:text/html,<script>alert("xss")</script>)';
    $expected = '[Click](data:text/html,&lt;script&gt;alert(&quot;xss&quot;)&lt;/script&gt;)';
    expect($service->convert($input))->toBe($expected);
});

// ============================================================================
// Integration with Other Markdown Features
// ============================================================================

test('escaped link with bold', function () {
    $service = new DiscordMarkdownService();
    $input = 'Visit **our site** at <https://example.com>';
    $result = $service->convert($input);
    expect($result)->toContain('<strong>our site</strong>');
    expect($result)->toContain('href="https://example.com"');
});

test('escaped link with italic', function () {
    $service = new DiscordMarkdownService();
    $input = 'Check the *docs* at <https://example.com/docs>';
    $result = $service->convert($input);
    expect($result)->toContain('<em>docs</em>');
    expect($result)->toContain('href="https://example.com/docs"');
});

test('named escaped link with bold', function () {
    $service = new DiscordMarkdownService();
    $input = '[**Important**](<https://example.com>)';
    $result = $service->convert($input);
    expect($result)->toContain('href="https://example.com"');
    expect($result)->toContain('<strong>Important</strong>');
});

test('escaped link with code', function () {
    $service = new DiscordMarkdownService();
    $input = 'Code: `example.com` at <https://example.com>';
    $result = $service->convert($input);
    expect($result)->toContain('<code>example.com</code>');
    expect($result)->toContain('href="https://example.com"');
});

test('escaped link in list', function () {
    $service = new DiscordMarkdownService();
    $input = "- Item 1\n- Visit <https://example.com>\n- Item 3";
    $result = $service->convert($input);
    expect($result)->toContain('<li>');
    expect($result)->toContain('href="https://example.com"');
});

// ============================================================================
// Edge Cases
// ============================================================================

test('escaped link without protocol', function () {
    $service = new DiscordMarkdownService();
    $input = '<example.com>';
    $expected = '&lt;example.com&gt;';
    expect($service->convert($input))->toBe($expected);
});

test('named escaped link with empty text', function () {
    $service = new DiscordMarkdownService();
    $input = '[](<https://example.com>)';
    $expected = '<a href="https://example.com" rel="noopener noreferrer" target="_blank"></a>';
    expect($service->convert($input))->toBe($expected);
});

test('escaped link with fragment', function () {
    $service = new DiscordMarkdownService();
    $input = '<https://example.com#section>';
    $expected = '<a href="https://example.com#section" rel="noopener noreferrer" target="_blank">https://example.com#section</a>';
    expect($service->convert($input))->toBe($expected);
});

test('unclosed angle bracket not treated as link', function () {
    $service = new DiscordMarkdownService();
    $input = 'This is <https://example.com without closing';
    $expected = 'This is &lt;https://example.com without closing';
    expect($service->convert($input))->toBe($expected);
});

// ============================================================================
// Comprehensive Examples
// ============================================================================

test('mixed link formats', function () {
    $service = new DiscordMarkdownService();
    $input = <<<'TEXT'
Here are different link formats:
1. [Standard](https://example.com)
2. <https://example.com>
3. [Escaped](<https://example.com>)
TEXT;
    $result = $service->convert($input);
    expect($result)->toContain('href="https://example.com"');
    expect(substr_count($result, '<a href='))->toBe(3);
});

test('complex paragraph', function () {
    $service = new DiscordMarkdownService();
    $input = 'Visit **<https://example.com>** for more info or check [docs](<https://example.com/docs>).';
    $result = $service->convert($input);
    expect($result)->toContain('href="https://example.com"');
    expect($result)->toContain('href="https://example.com/docs"');
});

// ============================================================================
// Discord Mentions
// ============================================================================

test('user mention without guild id', function () {
    $service = new DiscordMarkdownService();
    $input = 'Hello <@123456789>';
    $users = ['123456789' => 'Alice'];
    $result = $service->convert($input, [], $users);
    expect($result)->toContain('class="discord-mention discord-mention--user"');
    expect($result)->toContain('@Alice');
    expect($result)->not->toContain('href=');
});

test('user mention with guild id', function () {
    $service = new DiscordMarkdownService();
    $input = 'Hello <@123456789>';
    $users = ['123456789' => 'Alice'];
    $result = $service->convert($input, [], $users, [], '555666777');
    expect($result)->toContain('href="https://discord.com/users/123456789"');
    expect($result)->toContain('discord-mention--user');
    expect($result)->toContain('@Alice');
});

test('user mention with exclamation', function () {
    $service = new DiscordMarkdownService();
    $input = 'Hello <@!123456789>';
    $users = ['123456789' => 'Bob'];
    $result = $service->convert($input, [], $users, [], '555666777');
    expect($result)->toContain('href="https://discord.com/users/123456789"');
    expect($result)->toContain('@Bob');
});

test('channel mention', function () {
    $service = new DiscordMarkdownService();
    $input = 'Check <#987654321>';
    $channels = ['987654321' => 'announcements'];
    $result = $service->convert($input, $channels, [], [], '555666777');
    expect($result)->toContain('href="https://discord.com/channels/555666777/987654321"');
    expect($result)->toContain('discord-mention--channel');
    expect($result)->toContain('#announcements');
});

test('role mention', function () {
    $service = new DiscordMarkdownService();
    $input = 'Role: <@&111222333>';
    $roles = ['111222333' => 'Moderator'];
    $result = $service->convert($input, [], [], $roles);
    expect($result)->toContain('class="discord-mention discord-mention--role"');
    expect($result)->toContain('@Moderator');
    expect($result)->not->toContain('href=');
});

test('mention with unknown id', function () {
    $service = new DiscordMarkdownService();
    $input = 'User: <@999999999>';
    $result = $service->convert($input, [], []);
    expect($result)->toContain('User #999999999');
    expect($result)->toContain('discord-mention--user');
});

test('multiple mentions in text', function () {
    $service = new DiscordMarkdownService();
    $input = '<@123> and <#456> plus <@&789>';
    $users = ['123' => 'Alice'];
    $channels = ['456' => 'general'];
    $roles = ['789' => 'Admin'];
    $result = $service->convert($input, $channels, $users, $roles, 'guildid');
    expect($result)->toContain('@Alice');
    expect($result)->toContain('#general');
    expect($result)->toContain('@Admin');
    expect($result)->toContain('discord-mention--user');
    expect($result)->toContain('discord-mention--channel');
    expect($result)->toContain('discord-mention--role');
});

test('mentions with markdown formatting', function () {
    $service = new DiscordMarkdownService();
    $input = 'Hello **<@123456789>** and check <#987654321>';
    $users = ['123456789' => 'Alice'];
    $channels = ['987654321' => 'docs'];
    $result = $service->convert($input, $channels, $users, [], '555');
    expect($result)->toContain('<strong>');
    expect($result)->toContain('@Alice');
    expect($result)->toContain('#docs');
});

test('command mention', function () {
    $service = new DiscordMarkdownService();
    $input = 'Use </ping:123456789>';
    $result = $service->convert($input);
    expect($result)->toContain('href="/app#command-123456789"');
    expect($result)->toContain('discord-mention--command');
    expect($result)->toContain('/ping');
});

test('command mention with internal link', function () {
    $service = new DiscordMarkdownService();
    $input = 'Try </help:999> for more info';
    $result = $service->convert($input);
    expect($result)->toContain('href="/app#command-999"');
    expect($result)->toContain('/help');
});

test('mixed mentions and commands', function () {
    $service = new DiscordMarkdownService();
    $input = 'Ask <@123> or try </help:456> in <#789>';
    $users = ['123' => 'Alice'];
    $channels = ['789' => 'support'];
    $result = $service->convert($input, $channels, $users, [], 'guild');
    expect($result)->toContain('@Alice');
    expect($result)->toContain('/help');
    expect($result)->toContain('#support');
    expect($result)->toContain('discord-mention--user');
    expect($result)->toContain('discord-mention--command');
    expect($result)->toContain('discord-mention--channel');
});

test('small muted text', function () {
    $service = new DiscordMarkdownService();
    $input = 'This is normal text' . "\n" . '-# This is muted text';
    $result = $service->convert($input);
    expect($result)->toContain('<small class="muted">This is muted text</small>');
    expect($result)->toContain('This is normal text');
});

test('muted text at start of line only', function () {
    $service = new DiscordMarkdownService();
    $input = 'Text with -# in the middle should not be muted';
    $result = $service->convert($input);
    expect($result)->not()->toContain('<small class="muted">');
    expect($result)->toContain('-# in the middle');
});

test('multiple muted text lines', function () {
    $service = new DiscordMarkdownService();
    $input = "Normal line\n-# First muted\nAnother normal\n-# Second muted";
    $result = $service->convert($input);
    expect($result)->toContain('<small class="muted">First muted</small>');
    expect($result)->toContain('<small class="muted">Second muted</small>');
});
