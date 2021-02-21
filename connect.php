<?php
require 'vendor/autoload.php';
require 'config.php';

use GuzzleHttp\Client;

$client = new Client([
  // You can set any number of default request options. // 2 sec
  'timeout'  => 2.0,
  // 'verify' => __DIR__ . '/carert.pem'
]);

try {
  $response = $client->request('GET', 'https://accounts.google.com/.well-known/openid-configuration');

// dd(json_decode((string)$response->getBody()));
$discoveryJSON = json_decode($response->getBody());
$discoveryEndpoint = $discoveryJSON->token_endpoint;

$response = $client->request('POST', $discoveryEndpoint, [
  'form_params' => [
      'code' => $_GET['code'],
      'client_id' => GOOGLE_ID,
      'client_secret' => GOOGLE_SECRET,
      'redirect_uri' => PAGE_CONNECT,
      'grant_type' => 'authorization_code'
  ]
]);
// récupère l'access token de la reponse
$accessToken = json_decode($response->getBody())->access_token;
$userinfoEndpoint = $discoveryJSON->userinfo_endpoint;
$response = $client->request('GET', $userinfoEndpoint, [
  'headers' => [
    'Authorization' => 'Bearer ' . $accessToken
  ]
]);

$response = json_decode($response->getBody());
if ($response->email_verified === true) {
  session_start();
  $_SESSION['email'] = $response->email;
  header('Location: /secret.php');
  exit();
}
dd($accessToken);
} catch (\GuzzleHttp\Exception\ClientException $e) {
  dd($e->getMessage());
}

dd(json_decode((string)$response->getBody()));
echo $_GET['code'];