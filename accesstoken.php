<?php
function generateAccessToken($consumerKey, $consumerSecret) {
    $credentials = base64_encode($consumerKey . ':' . $consumerSecret);
    $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic ' . $credentials));
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $response = curl_exec($curl);
    curl_close($curl);

    $result = json_decode($response);
    return $result->access_token;
}

// Replace with your credentials
$consumerKey = 'KLTAqU7nDmnHHZm3d9eGOmPNrxWt86vpvv4JqfQHVYLGxCub';
$consumerSecret = 'GoYLs91UG6DLb0SCOjbdoNZQDgnc4Ber3I6hF4R4fwfQ7aiMo4ShoGobD7mAOBME';
$accessToken = generateAccessToken($consumerKey, $consumerSecret);
echo "Access Token: " . $accessToken;
?>
