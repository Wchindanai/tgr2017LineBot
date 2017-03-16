<?php
/**
 * Created by PhpStorm.
 * User: dream
 * Date: 3/16/2017 AD
 * Time: 12:53 PM
 */

$access_token = 'IUh8y7kZ3U4iXhHRN/S48+0fUqRVePqGhlR2wWQ4YDwB17bZmGj6iKWbYjIVC8ZvYobiV0nbt6LT6GBFJWS07CY8D2L8wMK9lzJ379h18JrkMefeCAeOqC3+WBeBlZTjAw/DAvNV8SsnfToIr/9u/QdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;

?>