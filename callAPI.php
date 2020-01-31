<?php

function callAPI($method, $url, $data)
{
    $user_key = "f13cb70db0f35158d3f963a643484b5e";

    $curl = curl_init();

    // Curl options
    curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => ['Accept: application/json', 'user-key: '.$user_key],
        CURLOPT_URL => $url,
    ));
    // ignore SSL certificate issues
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

    // Send the request
    $response = curl_exec($curl);

    // Check for errors if curl_exec fails
    if (!curl_exec($curl)) {
        die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
    }

    curl_close($curl);

    return $response;
}