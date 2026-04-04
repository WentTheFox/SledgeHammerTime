<?php

namespace App\Enums;

/**
 * @see https://docs.discord.com/developers/components/reference#component-object
 */
enum DiscordComponentType: int {
  case ACTION_ROW = 1;
  case BUTTON = 2;
  case STRING_SELECT = 3;
  case TEXT_INPUT = 4;
  case USER_SELECT = 5;
  case ROLE_SELECT = 6;
  case MENTIONABLE_SELECT = 7;
  case CHANNEL_SELECT = 8;
  case SECTION = 9;
  case TEXT_DISPLAY = 10;
  case THUMBNAIL = 11;
  case MEDIA_GALLERY = 12;
  case FILE = 13;
  case SEPARATOR = 14;
  case CONTAINER = 17;
  case LABEL = 18;
  case FILE_UPLOAD = 19;
  case RADIO_GROUP = 21;
  case CHECKBOX_GROUP = 22;
  case CHECKBOX = 23;
}
