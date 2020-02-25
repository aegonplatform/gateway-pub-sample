<?php
namespace GatewayPub\Test;

use PHPUnit\Framework\TestCase;
use GatewayPub\Gateway;

class GatewayTest extends TestCase {

  private $uri = 'http://localhost:3002';
  private $key = '6u23eJTVL4yNzprH6AlRo8nja3jT5ekv';
  private $secret = '01STgFyfRJ7yi17d8Uab1B7WU7M1TZ0L4tF2KGLSFkdhxs6P';
  private $ticker = 'BTC';
  private $customer;

  protected function setUp(): void {
    parent::setUp();
    $this->customer = [
      'cid' => 1,
      'name' => 'Test',
      'email' => 'test@test.com',
      'lang' => 'en',
    ];
  }

  /** @test */
  public function it_init() {
    $gateway = new Gateway($this->uri, $this->key, $this->secret);
    $this->assertInstanceOf(Gateway::class, $gateway);
  }

  /** @test */
  public function it_get_new_address() {
    $gateway = new Gateway($this->uri, $this->key, $this->secret);
    $result = $gateway->getNewAddress($this->ticker, false, $this->customer);
    $this->assertIsArray($result);
    $this->assertArrayHasKey('address', $result);
    $this->assertArrayHasKey('destTag', $result);
    $this->assertArrayHasKey('expired', $result);
  }

  /** @test */
  public function it_create_withdrawal() {
    $gateway = new Gateway($this->uri, $this->key, $this->secret);
    $result = $gateway->createwithdrawal(
      $this->ticker, '2NGZrVvZG92qGYqzTLjCAewvPZ7JE8S8VxE',
      0.001, '', '', $this->customer
    );
    $this->assertIsArray($result);
    $this->assertArrayHasKey('amount', $result);
    $this->assertArrayHasKey('scheduling', $result);
    $this->assertArrayHasKey('created', $result);
  }
}
