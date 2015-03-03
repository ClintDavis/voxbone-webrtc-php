<?php
/*
	To use, $.get to obtain the json data. 
	Pass that response to voxbone.WebRTC.init(data);

	This code is a 1-1 map of the NodeJS functions
 */


$username = ''; // Voxbone account name
$secret = ''; // Voxbone webrtc password

// Function mapped from NodeJS version
function cleanHmacDigest($hmac) {
    while ((strlen($hmac) % 4 != 0)) {
        $hmac .= '=';
    }
    $hmac = str_replace(' ', '+', $hmac);
    return $hmac;
};


$expires = time() + 300;
$text = $expires . ':' . $username;
$key = cleanHmacDigest(base64_encode(hash_hmac('sha1', $text, $secret, true)));

// Structure output array
$output = array('key'=>$key,'expires'=>$expires,'username'=>$username);

// Output as JSON
header('Content-Type: application/json');
echo json_encode($output);