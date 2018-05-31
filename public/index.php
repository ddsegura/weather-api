<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use GuzzleHttp\Client;

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App;
$app->get('/clima/{country}/{city}', function (Request $request, Response $response, array $args) {
	
	//get the city and country params, mexico city by default
	$city = isset($args["city"]) ? $args["city"] : "Mexico City";
	$country = isset($args["country"]) ? $args["country"] : "MX";
	
	$apiKey = "ce7cc9a87e299c1b47489a52d7bff1c4";
	$client = new GuzzleHttp\Client([ 'timeout'  => 2.0 ]);	
	
	$apiResponse = $client->request("GET", "https://api.openweathermap.org/data/2.5/weather", ["query" => ["APPID" => $apiKey, "q" => $city . "," . $country ]]);

	$dataToResponse = array("success" => false, "data" => array());
	
	if ($apiResponse->getStatusCode() == 200){
		$body = $apiResponse->getBody();
		$dataToResponse["success"] = true;
		$dataToResponse["data"] = json_decode($body->getContents());
	} 
	
	$newResponse = $response->withJson($dataToResponse);
    return $newResponse;
});
$app->run();
