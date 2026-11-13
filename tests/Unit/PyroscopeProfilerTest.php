<?php

namespace Tests\Unit;

use App\Support\PyroscopeProfiler;
use PHPUnit\Framework\TestCase;

class PyroscopeProfilerTest extends TestCase {
  public function test_it_profiles_only_when_configured_and_sampled():void {
    $this->assertTrue(PyroscopeProfiler::shouldProfile('http://pyroscope:4040', true, null, 0.1, 0.05));
    $this->assertFalse(PyroscopeProfiler::shouldProfile(null, true, null, 1.0, 0.0), 'no server configured');
    $this->assertFalse(PyroscopeProfiler::shouldProfile('http://pyroscope:4040', false, null, 1.0, 0.0), 'no extension');
    $this->assertFalse(PyroscopeProfiler::shouldProfile('http://pyroscope:4040', true, null, 0.1, 0.5), 'not one of the sampled requests');
    $this->assertFalse(PyroscopeProfiler::shouldProfile('http://pyroscope:4040', true, null, 0.0, 0.0), 'a rate of zero');
  }

  public function test_visitors_who_opted_out_are_never_profiled():void {
    $this->assertFalse(PyroscopeProfiler::shouldProfile('http://pyroscope:4040', true, '1', 1.0, 0.0));
  }

  public function test_the_name_carries_only_the_given_tags():void {
    $this->assertSame('sledgehammertime-beta-fpm{env=beta,version=abc1234}', PyroscopeProfiler::buildName('sledgehammertime-beta-fpm', ['env' => 'beta', 'version' => 'abc1234']));
    $this->assertSame('app{env=beta}', PyroscopeProfiler::buildName('app', ['env' => 'beta', 'version' => '']));
    $this->assertSame('app', PyroscopeProfiler::buildName('app', []));
  }

  public function test_characters_that_break_the_format_are_replaced():void {
    $this->assertSame('a_b{env=x_y_z}', PyroscopeProfiler::buildName('a b', ['env' => 'x{y}z']));
  }
}
