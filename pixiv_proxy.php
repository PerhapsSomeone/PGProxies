<?php
/**
 * Created by PhpStorm.
 * User: marc
 * Date: 12.04.19
 * Time: 18:25
 */

if(substr($_GET["url"], 0 , 22) !== "https://i.pximg.net/c/") {
    echo "Only pixiv links are allowed here.";
    exit;
}

$curl_h = curl_init($_GET["url"]);

curl_setopt($curl_h, CURLOPT_HTTPHEADER,
    array(
        'Referer: https://www.pixiv.net/',
    )
);

# do not output, but store to variable
curl_setopt($curl_h, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($curl_h);

$file_type = pathinfo($_GET["url"], PATHINFO_EXTENSION);

header("Content-Type: image/".$file_type);

echo $response;