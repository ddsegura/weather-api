<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App;
$app->get('/clima', function (Request $request, Response $response, array $args) {
    $data = array ("name" => "David Segura", "account_number" => "411113278");
	
	$newResponse = $response->withJson($data);
	
    return $newResponse;
});
$app->run();
