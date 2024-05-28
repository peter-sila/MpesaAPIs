<?php

include 'accesstoken.php';

function lipaNaMpesaOnline($accessToken) {
    $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
    $shortCode = '220220'; // Use the short code provided by Safaricom
    $timestamp = date('YmdHis');
    $Passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
    $password = base64_encode($shortCode . $Passkey . $timestamp);

    $curl_post_data = array(
        'BusinessShortCode' => $shortCode,
        'Password' => $password,
        'Timestamp' => $timestamp,
        'TransactionType' => 'CustomerPayBillOnline',
        'Amount' => '5',
        'PartyA' => '254794178635', // Customer's phone number in international format
        'PartyB' => $shortCode,
        'PhoneNumber' => '254794178635', // Customer's phone number in international format
        'CallBackURL' => '',
        'AccountReference' => '0782416883',
        'TransactionDesc' => 'Payment for testing'
    );

    $data_string = json_encode($curl_post_data);

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Authorization: Bearer ' . $accessToken));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

    $response = curl_exec($curl);
    curl_close($curl);

    return $response;
}

// Use the generated access token
$response = lipaNaMpesaOnline($accessToken);
echo "Response: " . $response;

?>