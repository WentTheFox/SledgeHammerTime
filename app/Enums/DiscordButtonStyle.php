<?php

namespace App\Enums;

/**
 * @see https://docs.discord.com/developers/components/reference#button-button-styles
 */
enum DiscordButtonStyle: int {
  /**
   * The most important or recommended action in a group of options
   */
  case PRIMARY = 1;
  /**
   * Alternative or supporting actions
   */
  case SECONDARY = 2;
  /**
   * Positive confirmation or completion actions
   */
  case SUCCESS = 3;
  /**
   * An action with irreversible consequences
   */
  case DANGER = 4;
  /**
   * Navigates to a URL
   */
  case LINK = 5;
  /**
   * Purchase
   */
  case PREMIUM = 6;
}
