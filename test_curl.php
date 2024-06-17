<?php

// use Yii;

function simpleCurlRequest()
{
    $url = "http://127.0.0.1:5000/predict";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Ensure the response is returned as a string
    curl_setopt($ch, CURLOPT_TIMEOUT, 300); // 300 seconds timeout
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); // 10 seconds connection timeout

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $error = curl_error($ch);

    curl_close($ch);

    if ($response === false) {
        error_log('cURL error: ' . $error);
        return 'Error: ' . $error;
    } else {
        error_log('HTTP code: ' . $http_code);
        error_log('Response: ' . $response);
        return $response;
    }
}

// Call the function
$response = simpleCurlRequest();
echo $response;
