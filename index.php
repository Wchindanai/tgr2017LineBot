<?php
/**
 * Created by PhpStorm.
 * User: dream
 * Date: 3/16/2017 AD
 * Time: 12:42 PM
 */
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient('IUh8y7kZ3U4iXhHRN/S48+0fUqRVePqGhlR2wWQ4YDwB17bZmGj6iKWbYjIVC8ZvYobiV0nbt6LT6GBFJWS07CY8D2L8wMK9lzJ379h18JrkMefeCAeOqC3+WBeBlZTjAw/DAvNV8SsnfToIr/9u/QdB04t89/1O/w1cDnyilFU=');
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => '1c1d6b241ba3c0294c3cefdd15ecea7f']);

?>