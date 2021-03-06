<?php
$access_token = 'IUh8y7kZ3U4iXhHRN/S48+0fUqRVePqGhlR2wWQ4YDwB17bZmGj6iKWbYjIVC8ZvYobiV0nbt6LT6GBFJWS07CY8D2L8wMK9lzJ379h18JrkMefeCAeOqC3+WBeBlZTjAw/DAvNV8SsnfToIr/9u/QdB04t89/1O/w1cDnyilFU=';
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://tgr2017day3.herokuapp.com/getdata'
));
$result = curl_exec($curl);
$jsonResult = json_decode($result);
curl_close($curl);
$img = $jsonResult->picture;


//Decode img from base64 && write file
$decodeImg = base64_decode($img);
$createFile = fopen("src/recent.jpg", "w") or die("Unable to open file!");
fwrite($createFile, $decodeImg);
fclose($createFile);




$responseText = "ความชื้นของดิน : $jsonResult->humidity %
สภาพอากาศ : $jsonResult->weather
ความกดอากาศ : $jsonResult->pressure pha
ความชื้นในอากาศ : $jsonResult->relative_humidity
อุณหภูมิ : $jsonResult->temperature";
$imgPath = "https://".$_SERVER['HTTP_HOST']."/src/recent.jpg";
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
    // Loop through each event
    foreach ($events['events'] as $event) {
        // Reply only when message sent is in 'text' format
        if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
            // Get text sent
            $text = $event['message']['text'];
            // Get replyToken
            $replyToken = $event['replyToken'];

            // Build message to reply back
            $messages = [
                'type' => 'text',
                'text' => $responseText
            ];
            $picture = [
                'type' => 'image',
                'originalContentUrl' => $imgPath,
                'previewImageUrl' => $imgPath
            ];

            // Make a POST Request to Messaging API to reply to sender
            $url = 'https://api.line.me/v2/bot/message/reply';
            $data = [
                'replyToken' => $replyToken,
                'messages' => [$messages, $picture],
            ];
            $post = json_encode($data);
            $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            $result = curl_exec($ch);
            curl_close($ch);

            echo $result . "\r\n";
        }
    }
}