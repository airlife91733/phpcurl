<?php

$url = 'http://140.130.12.6/toread/Logon,logon.sdirect';
$url = 'http://140.130.12.6/toread/logon';


// 找標籤 ...<form method="post" action="..."...>...</form>...


$post = [
    'formids'  => 'Hidden,If_0,username,password,Submit',    // hidden
    'seedids'  => 'ZH4sIAAAAAAAAAFvzloG1fCbDdJ3i1KKyzOR
                   UFQOdgsR0EJWcn1uQn5eaVwJm55UkZualFgH
                   ZxanFxZn5eSBWAZAIzkjNyQHSQak5iSUQcRg
                   z3gCZY4jMMQJyilJzgWZm5qV7pCamAPlO+Sm
                   VQMoxD0Tm5KeDzAIAx/mE/58AAAA=',           // hidden
    'Hidden'   => 'X',                                       // hidden
    'If_0'     => 'F',                                       // hidden
    //'browser'  => '',                                        // hidden
    'username' => '',
    'password' => '',
    'Submit'   => 'submit'
];

$ch = curl_init();

$options = [
    CURLOPT_URL            => $url,
    CURLOPT_HEADER         => 0,
    CURLOPT_VERBOSE        => 0,
    CURLOPT_RETURNTRANSFER => true,                     // Y
    CURLOPT_USERAGENT      => "Mozilla/4.0 (compatible;)",
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => http_build_query($post),
    CURLOPT_COOKIEJAR      =>  'cookie.txt',
    CURLOPT_COOKIEFILE     =>  'cookie.txt'
    
];

curl_setopt_array($ch, $options);

// CURLOPT_RETURNTRANSFER=true 會傳回網頁回應,
// false 時只回傳成功與否

$result = curl_exec($ch);
curl_close($ch);

//echo htmlentities(substr($result, 3145, -934));

// uid       : 933315
// title     : onepiece海賊王 第521話
// author    : likesea
// link      : http://.............


// formids  => 'Hidden,If_0,username,password,Submit',    // hidden
// seedids  => 'ZH4sIAAAAAAAAAFvzloG1fCbDdJ3i1KKyzOR
// Hidden   => 'X',                                       // hidden
// If_0     => 'F',                                       // hidden
// 'username' => '',
// 'password' => '',


class curl {
    
    public $formids;
    public $seedids;
    public $Hidden;
    public $If_0;
    
    
    function parse_selector($selector_string) {
        
        $pattern = "/([\w-:\*]*)(?:\#([\w-]+)|\.([\w-]+))?(?:\[@?(!?[\w-:]+)(?:([!*^$]?=)[\"']?(.*?)[\"']?)?\])?([\/, ]+)/is";
        
        /*************************************************************************************************
        *  preg_match_all(string $pattern,                      // 要搜索的模式，String。                *
        *                 string $subject [,                    // 輸入，String。                        *
        *                 array &$matches [,                    // 輸出，多維Array，排序由$flags指定。   *
        *                 int $flags [,                         // PREG_PATTERN_ORDER 和 PREG_SET_ORDER  *
        *                 int $offset = 0 ]]]                                                            *
        *                 )                                                                              *
        *************************************************************************************************/
        preg_match_all($pattern,
                       trim($selector_string).' ',    // trim，移除字串兩側的空格。
                       $matches,
                       PREG_SET_ORDER
                       );
        
        return $matches;
        //return $selectors;
    }
    
}

$app = new curl;

echo '<pre>';
print_r($app->parse_selector($result));
echo '</pre>';

//echo $result;

?>
