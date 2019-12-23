<?php
/**
 * -------------------------------------------
 * php -sS localhost:8080 examples/webhook.php
 * -------------------------------------------
 */
$pathDir = __DIR__ . '/log/test';
if (!is_dir($pathDir)) {
    mkdir($pathDir, 0777, true);
}
$qs = '';
if(isset($_SERVER['QUERY_STRING'])){
    $qs = $_SERVER['QUERY_STRING'] . PHP_EOL;
    echo '<strong>' . $qs . '</strong><br />';
}
echo '<pre>';
ob_start();
var_dump($_GET);
$output = ob_get_contents();
ob_end_clean();
echo $output;
echo '</pre>';
$fp = fopen($pathDir . '/output.log', 'a');
fwrite($fp, $qs . $output);
fclose($fp);

/**
 * @see Deposit output - Transaction started on blockchain
 */
//   array(3) {
//     ["event"]=>
//     string(11) "address"
//     ["data"]=>
//     array(12) {
//       ["ticker"]=>
//       string(3) "btc"
//       ["type"]=>
//       string(10) "deposit"
//       ["status"]=>
//       string(8) "blockchain"
//       ["amount"]=>
//       string(5) "0.001"
//       ["address"]=>
//       string(35) "2NGZrVvZG92qGYqzTLjCAewvPZ7JE8S8VxE"
//       ["txid"]=>
//       string(64) "8acba0abfb239e2d9b23952adc374d40a260e2ab0189d638694bc7c06a3ac98e"
//       ["confirmations"]=>
//       string(1) "3"
//       ["fee"]=>
//       string(11) "-0.00000222"
//       ["scheduling"]=>
//       string(13) "1576881386109"
//       ["created"]=>
//       string(13) "1576881386112"
//       ["finished"]=>
//       string(13) "1576881577239"
//       ["customer"]=>
//       array(4) {
//         ["email"]=>
//         string(13) "test@test.com"
//         ["name"]=>
//         string(4) "Test"
//         ["lang"]=>
//         string(2) "en"
//         ["thumbnail"]=>
//         string(32) "http://img.images.com/avatar.jpg"
//       }
//     }
//     ["secret"]=>
//     string(8) "pSNx4Dhi"
//   }

/**
 * @see Deposit output - Transaction finalized on blockchain
 */
//   array(3) {
//     ["event"]=>
//     string(11) "transaction"
//     ["data"]=>
//     array(12) {
//       ["ticker"]=>
//       string(3) "btc"
//       ["type"]=>
//       string(10) "deposit"
//       ["status"]=>
//       string(8) "finished"
//       ["amount"]=>
//       string(5) "0.001"
//       ["address"]=>
//       string(35) "2NGZrVvZG92qGYqzTLjCAewvPZ7JE8S8VxE"
//       ["txid"]=>
//       string(64) "8acba0abfb239e2d9b23952adc374d40a260e2ab0189d638694bc7c06a3ac98e"
//       ["confirmations"]=>
//       string(1) "3"
//       ["fee"]=>
//       string(11) "-0.00000222"
//       ["scheduling"]=>
//       string(13) "1576881386109"
//       ["created"]=>
//       string(13) "1576881386112"
//       ["finished"]=>
//       string(13) "1576881577239"
//       ["customer"]=>
//       array(4) {
//         ["email"]=>
//         string(13) "test@test.com"
//         ["name"]=>
//         string(4) "Test"
//         ["lang"]=>
//         string(2) "en"
//         ["thumbnail"]=>
//         string(32) "http://img.images.com/avatar.jpg"
//       }
//     }
//     ["secret"]=>
//     string(8) "pSNx4Dhi"
//   }

/**
 * @see Withdrawal output - Transaction finalized on blockchain
 */
//   array(3) {
//     ["event"]=>
//     string(11) "transaction"
//     ["data"]=>
//     array(12) {
//       ["ticker"]=>
//       string(3) "btc"
//       ["type"]=>
//       string(10) "withdrawal"
//       ["status"]=>
//       string(8) "finished"
//       ["amount"]=>
//       string(5) "0.001"
//       ["address"]=>
//       string(35) "2NGZrVvZG92qGYqzTLjCAewvPZ7JE8S8VxE"
//       ["txid"]=>
//       string(64) "8acba0abfb239e2d9b23952adc374d40a260e2ab0189d638694bc7c06a3ac98e"
//       ["confirmations"]=>
//       string(1) "3"
//       ["fee"]=>
//       string(11) "-0.00000222"
//       ["scheduling"]=>
//       string(13) "1576881386109"
//       ["created"]=>
//       string(13) "1576881386112"
//       ["finished"]=>
//       string(13) "1576881577239"
//       ["customer"]=>
//       array(4) {
//         ["email"]=>
//         string(13) "test@test.com"
//         ["name"]=>
//         string(4) "Test"
//         ["lang"]=>
//         string(2) "en"
//         ["thumbnail"]=>
//         string(32) "http://img.images.com/avatar.jpg"
//       }
//     }
//     ["secret"]=>
//     string(8) "pSNx4Dhi"
//   }
