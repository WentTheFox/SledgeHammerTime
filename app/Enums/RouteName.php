<?php

namespace App\Enums;

enum RouteName: string {
  case ADD_BOT = 'addBot';
  case ADD_BOT_NO_LOCALE = 'addBotNoLocale';
  case ADD_BOT_REDIRECT = 'addBotRedirect';
  case ANALYTICS = 'analytics';
  case API = 'api';
  case API_KEYS_DESTROY = 'api-keys.destroy';
  case API_KEYS_ROTATE = 'api-keys.rotate';
  case API_KEYS_STORE = 'api-keys.store';
  case APP_ANALYTICS = 'app.analytics';
  case APP_GET_LOCAL_SETTINGS = 'app.getLocalSettings';
  case APP_LOCAL_USER_INFO = 'app.localUserInfo';
  case APP_NTP = 'app.ntp';
  case APP_PERSIST_LOCAL_SETTINGS = 'app.persistLocalSettings';
  case APP_TRANSLATION_PROGRESS = 'app.translationProgress';
  case APP_USAGE = 'app.usage';
  case APP_USER_INFO = 'app.userInfo';
  case APP_WEBHOOK_DELIVERY_STATS = 'app.webhookDeliveryStats';
  case BOT_INFO = 'botInfo';
  case BOT_LOGIN = 'botLogin';
  case CREDIT_OVERRIDES_CANCEL_PROPOSAL = 'credit-overrides.cancel-proposal';
  case CREDIT_OVERRIDES_COPY = 'credit-overrides.copy';
  case CREDIT_OVERRIDES_DELETE = 'credit-overrides.delete';
  case CREDIT_OVERRIDES_UPSERT = 'credit-overrides.upsert';
  case DESIGN = 'design';
  case DISCORD = 'discord';
  case HOME = 'home';
  case LEGAL = 'legal';
  case LOGIN = 'login';
  case LOGOUT = 'logout';
  case OAUTH_REDIRECT = 'oauthRedirect';
  case PROFILE_DESTROY = 'profile.destroy';
  case PROFILE_EDIT = 'profile.edit';
  case PROFILE_UPDATE = 'profile.update';
  case ROOT = 'root';
  case SETTINGS = 'settings';
  case SETTINGS_SET = 'settings.set';
  case SITEMAP = 'sitemap';
  case STATUS = 'status';
}
