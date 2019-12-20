<?php
/**
 * -------------------------------------------
 * php -sS localhost:8080 examples/webhook.php
 * -------------------------------------------
 */
$output = print_r($_GET, TRUE);
$fp = fopen('examples/log/output.log', 'a');
fwrite($fp, $output);
fclose($fp);

/**
 * @see Deposit output - Transaction started on blockchain
 */
// Array
// (
//     [event] => address
//     [data] => Array
//         (
//             [ticker] => btc
//             [type] => deposit
//             [status] => blockchain
//             [amount] => 0.01
//             [address] => mpMTXspxiLBirbk3pRzd2pHVcG1wYFyFde
//             [txid] => d0749ed7db36719ac80e71f5063de027842649572e5ec93ba7c4fed5efd46f43
//             [confirmations] => 0
//             [checked] => false
//             [approved] => true
//             [auto] => true
//             [created] => 1576881259342
//             [email] => test@test.com
//             [applicationId] => 5dfd36798043d51c54c6930e
//         )
//     [secret] => pSNx4Dhi
// )

/**
 * @see Deposit output - Transaction finalized on blockchain
 */
// Array
// (
//     [event] => transaction
//     [data] => Array
//         (
//             [ticker] => btc
//             [type] => deposit
//             [status] => finished
//             [amount] => 0.01
//             [address] => mpMTXspxiLBirbk3pRzd2pHVcG1wYFyFde
//             [txid] => d0749ed7db36719ac80e71f5063de027842649572e5ec93ba7c4fed5efd46f43
//             [confirmations] => 3
//             [checked] => true
//             [approved] => true
//             [auto] => true
//             [created] => 1576881259342
//             [finished] => 1576881314280
//             [email] => test@test.com
//             [applicationId] => 5dfd36798043d51c54c6930e
//             [id] => 5dfd4c6b6a9f524db971698e
//         )
//     [secret] => pSNx4Dhi
// )

/**
 * @see Withdrawal output - Transaction finalized on blockchain
 */
// Array
// (
//     [event] => transaction
//     [data] => Array
//         (
//             [ticker] => btc
//             [type] => withdrawal
//             [status] => finished
//             [amount] => 0.001
//             [address] => 2NGZrVvZG92qGYqzTLjCAewvPZ7JE8S8VxE
//             [txid] => 8acba0abfb239e2d9b23952adc374d40a260e2ab0189d638694bc7c06a3ac98e
//             [confirmations] => 3
//             [fee] => -0.00000222
//             [checked] => true
//             [approved] => true
//             [auto] => true
//             [scheduling] => 1576881386109
//             [created] => 1576881386112
//             [finished] => 1576881577239
//             [email] => test@test.com
//             [applicationId] => 5dfd36798043d51c54c6930e
//             [id] => 5dfd4ceac01e0c4a95d1e3cd
//         )
//     [secret] => pSNx4Dhi
// )
