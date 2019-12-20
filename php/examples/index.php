<?php
/**
 * -------------------------------------------
 * php -f examples/index.php
 * -------------------------------------------
 */
require __DIR__ . '/../vendor/autoload.php';

use GatewayPub\Gateway;

$uri = 'http://localhost:3002'; // My gateway URI
$key = '4YvMUp6xP7PEVXqW3NyZm9LBkmycJ9cu'; // My key
$secret = '3B2PhQoESpk5xVHi49qtl8Jr5WZtS2N7iVuoe9jR8Jg5F7Oh'; // My secret

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