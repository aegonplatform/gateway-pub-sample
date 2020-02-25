<?php
/**
 * -------------------------------------------
 * php -f examples/index.php
 * -------------------------------------------
 */
require __DIR__ . '/../../vendor/autoload.php';

use GatewayPub\Gateway;

$uri = 'http://localhost:3002'; // My gateway URI
$key = '6u23eJTVL4yNzprH6AlRo8nja3jT5ekv'; // My key
$secret = '01STgFyfRJ7yi17d8Uab1B7WU7M1TZ0L4tF2KGLSFkdhxs6P'; // My secret

$customer = [
    'cid' => 1,
    'name' => 'Test',
    'email' => 'test@test.com',
    'lang' => 'en',
];
$gateway = new Gateway($uri, $key, $secret);
$result = $gateway->getNewAddress('BTC', false, $customer);
echo 'getNewAddress = ';
print_r($result);
$result = $gateway->createwithdrawal(
    'BTC', '2NGZrVvZG92qGYqzTLjCAewvPZ7JE8S8VxE', 0.001, '', '', $customer
);
echo 'createWithdrawal = ';
print_r($result);
