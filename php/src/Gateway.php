<?php
namespace GatewayPub;

class Gateway {

    public function __construct($uri, $key, $secret) {
        $this->uri = $uri;
        $this->key = $key;
        $this->secret = $secret;
    }

    private function getURI() : string {
        $parse = (object) parse_url($this->uri);
        $uri = "{$parse->scheme}://{$parse->host}";
        if (isset($parse->port)) $uri .= ":{$parse->port}";
        return $uri;
    }

    private function getQueryString(array $data) : string {
        if (isset($data['customer'])) {
            $data['customer'] = json_encode($data['customer']);
            $data['customer'] = str_replace('\/', '/', $data['customer']);
            $data['customer'] = str_replace('\\"', '"', $data['customer']);
        }
        if (isset($data['fromMaster'])) {
            $data['fromMaster'] = $data['fromMaster'] === false ? 'false' : 'true';
        }
        return http_build_query($data);
    }

    private function getSignature(string $endpoint, array $data) : string {
        $search = $this->getQueryString($data);
        $message = json_encode([
            'cmd' => $endpoint,
            'key' => $this->key,
            'search' => $search,
        ]);
        $message = str_replace('\/', '/', $message);
        return hash_hmac('sha512', $message, $this->secret);
    }

    private function executeRequest(string $endpoint, array $data = []) : array {
        $uri = $this->getURI() . $endpoint;
        $qs = $this->getQueryString($data);
        $now = new \DateTime("now", new \DateTimeZone("UTC"));
        $timestamp = $now->getTimestamp() * 1000;
        $signature = $this->getSignature($endpoint, $data);
        $options = [
            'http' => [
                'method' => 'GET',
                'header' => implode("\r\n", [
                    'Accept: application/json',
                    'Content-Type: application/json',
                    "Ag-Access-Key: {$this->key}",
                    "Ag-Access-Timestamp: {$timestamp}",
                    "Ag-Access-Signature: {$signature}",
                ]),
            ],
        ];
        $context = stream_context_create($options);
        $file = file_get_contents("{$uri}?{$qs}", false, $context);
        return json_decode($file, true);
    }

    public function getNewAddress(
      string $ticker, bool $fromMaster = false,
      array $customer = [], string $referenceId = ''
    ) : array {
        $ticker = strtolower($ticker);
        $email = $customer['email'];
        $customer = array_filter($customer, function($key) {
            return in_array($key, ['cid', 'name', 'lang']);
        }, ARRAY_FILTER_USE_KEY);
        return $this->executeRequest('/api/deposits/getnewaddress', [
            'ticker' => $ticker,
            'email' => $email,
            'fromMaster' => $fromMaster,
            'customer' => $customer,
            'referenceId' => $referenceId,
        ]);
    }

    public function createWithdrawal(
        string $ticker, string $address, float $amount, string $destTag = '',
        string $note = '', array $customer = [], string $referenceId = ''
    ) {
        $ticker = strtolower($ticker);
        $email = $customer['email'];
        $customer = array_filter($customer, function($key) {
            return in_array($key, ['cid', 'name', 'lang']);
        }, ARRAY_FILTER_USE_KEY);
        return $this->executeRequest('/api/withdrawals/createwithdrawal', [
            'ticker' => $ticker,
            'email' => $email,
            'address' => $address,
            'amount' => $amount,
            'destTag' => $destTag,
            'note' => $note,
            'customer' => $customer,
            'referenceId' => $referenceId,
        ]);
    }
}
