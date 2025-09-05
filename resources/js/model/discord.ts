import { BotCommandOptionChoiceList } from '@/Pages/BotInfo/BotCommandOptionChoices.vue';

export enum DiscordBotCommandType {
  /**
   * Slash commands
   */
  ChatInput = 1,
  /**
   * User right-click menu
   */
  User = 2,
  /**
   * Message right-click menu
   */
  Message = 3,
}

export enum DiscordBotCommandOptionType {
  SUB_COMMAND = 1,
  STRING = 3,
  INTEGER = 4,
  BOOLEAN = 5,
  NUMBER = 10,
}

export interface BotCommandOption {
  id: string;
  name: string;
  description: string;
  /**
   * @see DiscordBotCommandOptionType
   */
  type: number;
  required: boolean | null;
  min_value: number | null;
  max_value: number | null;
  min_length: number | null;
  max_length: number | null;
  choices?: BotCommandOptionChoiceList;
  total_uses: number | null;
  deleted_at: string | null;
}

export interface BotCommand {
  id: string;
  name: string;
  description: string;
  options?: BotCommandOption[];
  type: DiscordBotCommandType;
  total_executions: number | null;
}

export interface BotCommandOptionChoice {
  id: string;
  name: string;
  value: string;
}
