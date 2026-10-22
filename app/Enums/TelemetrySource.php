<?php

namespace App\Enums;

/**
 * Where a command run came from.
 */
enum TelemetrySource: string {
  case DISCORD_BOT = "discord-bot";
  case API = "api";
  case MCP = "mcp";
}
