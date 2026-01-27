<?php

namespace Tests;

/**
 * Keep in sync with `resources/css/design/_common.scss`
 */
enum Breakpoint: int {
  case sm = 400;
  case md = 768;
  case lg = 1024;
  case xl = 1200;
  case xxl = 1600;
}
