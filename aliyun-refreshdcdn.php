<?php if ($argc != 2 || in_array($argv[1], array('--help', '-?', '-h'))): ?>

Usage: <?php echo $argv[0]; ?> <url>
<url> is required.

Supported domains: www.77you.net app.7724.com
API Doc: https://help.aliyun.com/document_detail/89686.html

<?php else: ?>

<?php
    define('KEY_ID', 'LTAI8T1I9Tnhvz0F');
    define('KEY_SECRET', 'GJXWwDah7KY4Jkr5ewcru4HGGiEUw0');
    date_default_timezone_set('UTC');
    
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
    
    function genUrl($params)
    {
        $sign = $params;
        ksort($sign);
        $sign = 'GET&%2F&' . rawurlencode(http_build_query($sign));
        $sign = base64_encode(hash_hmac('sha1', $sign, KEY_SECRET . '&', true));
        return 'http://dcdn.aliyuncs.com/?' . http_build_query(array_merge($params, ['Signature' => $sign]));
    }
    
    $publicParams = [
        'Format' => 'JSON',
        'Version' => '2018-01-15',
        'AccessKeyId' => KEY_ID,
        'SignatureMethod' => 'HMAC-SHA1',
        'Timestamp' => date('Y-m-d\TH:i:s\Z'),
        'SignatureVersion' => '1.0',
        'SignatureNonce' => time(),
    ];
    
    // 请求URL缓存刷新
    $params = array_merge($publicParams,
                          ['Action' => 'RefreshDcdnObjectCaches',
                           'ObjectPath' => $argv[1],
                           'ObjectType' => 'File']
                        );
    $res = httpGet(genUrl($params));
    $res['httpCode'] == 200 ? print $res['data'] : print_r($res);
    
    // 查询URL剩余可刷新次数
    $params = array_merge($publicParams, ['Action' => 'DescribeDcdnRefreshQuota']);
    $res = httpGet(genUrl($params));
    if ($res['httpCode'] == 200) {
        $data = json_decode($res['data'], true);
        print "\r\n\r\n" . 'UrlQuota:' . $data['UrlQuota'] . ' ' . 'UrlRemain:' . $data['UrlRemain'];
    }
?>

<?php endif; ?>