<?php
include 'headers.php';
require_once 'guzzle.phar';

// https://my.plexapp.com/pms/servers

$token = $_GET['token'];
$client = new Guzzle\Service\Client('https://my.plexapp.com');
$commandURL = '/pms/servers?' . TOKEN_PARAM . '=' . $token;

$request = $client->get($commandURL, array(
	'Content-Length'			=> 0,
	HEADER_PLATFORM				=> VALUE_PLATFORM,
	HEADER_PLATFORM_VERSION		=> VALUE_PLATFORM_VERSION,
	HEADER_PROVIDES				=> VALUE_PROVIDES,
	HEADER_PRODUCT				=> VALUE_PRODUCT,
	HEADER_VERSION				=> VALUE_VERSION,
	HEADER_DEVICE				=> VALUE_DEVICE,
	HEADER_CLIENT				=> VALUE_CLIENT
	)
);

$request->getCurlOptions()->set(CURLOPT_SSL_VERIFYHOST, false);
$request->getCurlOptions()->set(CURLOPT_SSL_VERIFYPEER, false);

$response = $client->send($request);

echo $response->getBody();
?>