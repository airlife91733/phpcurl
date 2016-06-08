<?php
//crawler
//$url = 'https://ibank.firstbank.com.tw/NetBank/7/1501.html?sh=none';

$curl = new curl;

//$curl->url = 'https://ibank.firstbank.com.tw/NetBank/7/1501.html?sh=none';
$curl->url = 'http://140.130.12.6/toread/Logon,logon.sdirect'; // Referer
//$curl->url = 'http://140.130.12.6/toread/Logon,logon.sdirect'; // Request URL

class curl {
    
    public $url;
    
    function __construct() {
        //$curl = curl_init();
        //$this->$url = 'begin';
    }
    
    // 抓網站資料
    function crawl_site() {
        /* PHP curl_setopt: http://php.net/manual/zh/function.curl-setopt.php
        * CURL 中 SSL 的相關設置: http://www.plurk.com/p/e797gs
        * submit form: http://stackoverflow.com/questions/11835283/why-cant-i-submit-form-php-curl
        */
        
        $submit_url = $this->url;
        //$user = 'img:0930667907';
        $user_agent = 'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:45.0) Gecko/20100101 Firefox/45.0';
        $referer_url = $this->url;
        //$cookies = 'tinreadMode=cata; JSESSIONID=';
        $cookie = 'cookie.txt';
        $post = [
            'formids' => 'Hidden,If_0,username,password,Submit',                    // hidden
            'seedids' => 'ZH4sIAAAAAAAAAFvzloG1fCbDdJ3i1KKyzORUFQOdgsR0EJWcn1uQn5eaVwJ
                          m55UkZualFgHZxanFxZn5eSBWAZAIzkjNyQHSQak5iSUQcRgz3gCZY4jMMQJ
                          yilJzgWZm5qV7pCamAPlO+SmVQMoxD0Tm5KeDzAIAx/mE/58AAAA=',   // hidden
            'Hidden' => 'X',            // hidden
            'If_0' => 'F',              // hidden
            'browser' => '',            // hidden
            'username' => '',
            'password' => '',
            'Submit' => 'submit'
            ];
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $submit_url);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);     // true = 回傳網頁回應 / false = 只回傳成功與否
        curl_setopt($ch, CURLOPT_REFERER, $submit_url);     // 設置header中"Referer:"部分的值
        //curl_setopt($ch, CURLOPT_USERPWD, $user);           // 傳遞一個連接中需要的用戶名和密碼，格式為："[username]:[password]"
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_NTLM);  // HTTP 驗證
        // CURLAUTH_BASIC, CURLAUTH_DIGEST, CURLAUTH_GSSNEGOTIATE, CURLAUTH_NTLM, CURLAUTH_ANY, CURLAUTH_ANYSAFE
        //curl_setopt($ch, CURLOPT_SSLVERSION, 3);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);    // true = 預設值, 驗證伺服器 / false = 憑證關閉驗證
        //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        //curl_setopt($ch, CURLOPT_HEADER, true); // 會出現訊息
        
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post );
        
        // Request Header Name, Value
        // Host: 140.130.12.6
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent); // User-Agent
        // Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8
        // Accept-Language: zh-TW,zh;q=0.8,en-US;q=0.5,en;q=0.3
        // Accept-Encoding: gzip, deflate
        // DNT: 1
        //curl_setopt($ch, CURLOPT_REFERER, $referer_url);     // 設置header中"Referer:"部分的值
        /* Logout
           http://140.130.12.6/toread/Logon,logon.sdirect;jsessionid=6A33E1418A743E3278D891219A6133E1
           tinreadMode=cata; JSESSIONID=6A33E1418A743E3278D891219A6133E1*/
        //curl_setopt($ch, CURLOPT_COOKIESESSION, true);
        //curl_setopt($ch, CURLOPT_COOKIE,  $cookies);
        curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookie);       // CURL 收到的 HTTP Response 中的 Set-Cookie 要存放在哪。
        curl_setopt ($ch, CURLOPT_COOKIEFILE, $cookie);      // CURL 要發出的 HTTP Request 的 Cookie 存放在哪。
        // Cookie: tinreadMode=cata; JSESSIONID=6A33E1418A743E3278D891219A6133E1
        
        // Post Parameter Name, Value
        // formids: Hidden,If_0,username,password,Submit
        // seedids: ZH4sIAAAAAAAAAFvzloG1fCbDdJ3i1KKyzORUFQOdgsR0EJWcn1uQn5eaVwJm55UkZualFgHZxanFxZn5eSBWAZAIzkjNyQHSQak5iSUQcRgz3gCZY4jMMQJyilJzgWZm5qV7pCamAPlO%2BSmVQMoxD0Tm5KeDzAIAx%2FmE%2F58AAAA%3D
        // Hidden: X
        // If_0: F
        // browser: Firefox
        // username
        // password
        // submit: %E7%99%BB%E5%85%A5
        
        $result = curl_exec($ch);
        curl_close($ch);
        
        return $result;
    }
    
    function __destruct() {
        //curl_close($curl);
    }
}

?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8" /> 
</head>
<body>
<?php echo $curl->crawl_site(); ?>
</body>
</html>
