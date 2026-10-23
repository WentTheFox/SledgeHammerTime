<?php

namespace Tests\Feature;

use App\Support\ReadOnlyMode;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use Tests\Support\SchemaAtRef;
use Tests\TestCase;

/**
 * Simulates the deploy window where the new code is live but its migrations are not applied yet:
 * the database is reverted to the schema of DEPLOY_BASE_REF (default origin/main) while read-only mode is on.
 */
#[Group('deploy-window')]
class ReadOnlyDeployWindowTest extends TestCase {
  /** @var string[] */
  private array $reverted = [];

  protected function setUp():void {
    parent::setUp();

    // Reverting migrations is destructive, so never do it against anything but a dedicated test database
    if (!str_ends_with((string) config('database.connections.'.config('database.default').'.database'), '_test')){
      $this->markTestSkipped('Deploy-window tests only run against a database whose name ends in "_test".');
    }

    $ref = env('DEPLOY_BASE_REF', 'origin/main');
    $this->reverted = SchemaAtRef::pendingSince($ref);
    if ($this->reverted === []){
      $this->markTestSkipped("No migrations differ from $ref, nothing to simulate.");
    }
    SchemaAtRef::migrateToHead();
    SchemaAtRef::revert($this->reverted);
    ReadOnlyMode::disable();
  }

  protected function tearDown():void {
    ReadOnlyMode::disable();
    if ($this->reverted !== []){
      SchemaAtRef::migrateToHead();
    }
    parent::tearDown();
  }

  /**
   * @return array<string, array{string}>
   */
  public static function readRoutes():array {
    return [
      'home' => ['/en'],
      'legal' => ['/en/legal'],
      'design' => ['/en/design'],
      'add bot' => ['/en/add-bot'],
      'bot info' => ['/en/app'],
      'api' => ['/en/api'],
      'status' => ['/status'],
      'sitemap' => ['/sitemap.xml'],
      'ntp' => ['/frontend/ntp'],
      'app usage' => ['/frontend/app-usage'],
      'webhook stats' => ['/frontend/webhook-delivery-stats'],
    ];
  }

  #[DataProvider('readRoutes')]
  public function test_reads_stay_responsive_with_pending_migrations(string $uri):void {
    ReadOnlyMode::enable();

    $response = $this->get($uri);

    $this->assertLessThan(500, $response->getStatusCode(), "GET $uri failed with new code + old schema");
  }

  public function test_status_reports_healthy_as_json_while_read_only():void {
    ReadOnlyMode::enable();

    $this->getJson('/status')->assertOk()->assertJson(['status' => 'ok', 'checks' => ['database' => true, 'cache' => true]]);
  }

  public function test_page_views_are_not_recorded_while_read_only():void {
    ReadOnlyMode::enable();
    $before = DB::table('page_views')->count();

    $this->get('/en')->assertOk();

    $this->assertSame($before, DB::table('page_views')->count());
  }

  /**
   * @return array<string, array{string, string}>
   */
  public static function writeRequests():array {
    return [
      'profile update' => ['patch', '/profile'],
      'profile delete' => ['delete', '/profile'],
      'settings' => ['put', '/settings/1'],
      'logout' => ['post', '/logout'],
      'api bot commands' => ['put', '/api/bot-commands'],
      'api command telemetry' => ['post', '/api/command-telemetry'],
      'bot login' => ['get', '/bot-login/1/en'],
      'oauth callback' => ['get', '/oauth/callback/discord'],
    ];
  }

  #[DataProvider('writeRequests')]
  public function test_writes_are_rejected_with_retry_after(string $method, string $uri):void {
    ReadOnlyMode::enable();

    $response = $this->json($method, $uri);

    $response->assertStatus(503);
    $this->assertNotEmpty($response->headers->get('Retry-After'));
  }

  public function test_without_read_only_mode_the_old_schema_breaks_page_views():void {
    // Negative control: proves the reads above only pass because of the read-only guard
    $this->withoutExceptionHandling();
    $this->expectException(\Throwable::class);

    $this->get('/en');
  }
}
