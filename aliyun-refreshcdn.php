<?php if ($argc != 2 || in_array($argv[1], array('--help', '-?', '-h'))): ?>

Usage: <?php echo $argv[0]; ?> <url>
<url> is required.

Supported domains: play.7724.com img.7724.com
API Doc: https://help.aliyun.com/document_detail/91164.html

<?php else: ?>

<?php
    define('KEY_ID', 'LTAIx9xRLBRBiJZk');
    define('KEY_SECRET', 'kbGaDVHHHT0Bt7gtWMPp3lNm3J1p9G');
    date_default_timezone_set('UTC');
    
    $params = [
        'Format' => 'JSON',
        'Version' => '2018-05-10',
        'AccessKeyId' => KEY_ID,
        'SignatureMethod' => 'HMAC-SHA1',
        'Timestamp' => date('Y-m-d\TH:i:s\Z'),
        'SignatureVersion' => '1.0',
        'SignatureNonce' => time(),
        'Action' => 'RefreshObjectCaches',
        'ObjectPath' => $argv[1],
    ];
    
    // 签名
    $sign = $params;
    ksort($sign);
    $sign = 'GET&%2F&' . rawurlencode(http_build_query($sign));
    $sign = base64_encode(hash_hmac('sha1', $sign, KEY_SECRET . '&', true));
    
    function httpGet($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return compact('data', 'httpCode');
    }

    $fields = http_build_query(array_merge($params, ['Signature' => $sign]));
    $res = httpGet('http://cdn.aliyuncs.com/?' . $fields);
    $res['httpCode'] == '200' ? print $res['data'] : print_r($res);
?>

<?php endif; ?>