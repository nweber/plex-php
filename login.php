<?php
include 'headers.php';
require_once 'guzzle.phar';

// auth good | bWVyc2lhbjpwdDFta3QxbWs=
// auth bad  | bWVyc2lhbjpib28=
// http://localhost:8070/plex/services/login.php?auth=base64encode(username:password)
// https://my.plexapp.com/users/sign_in.xml

$auth = $_GET['auth'];
$client = new Guzzle\Service\Client('https://my.plexapp.com');

$request = $client->post('/users/sign_in.xml', array(
	'Authorization'				=> 'Basic ' . $auth,
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