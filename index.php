<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require 'config/constants.php';
require 'config/config.php';

$app = new \Slim\App(['settings' => $config]);

$container = $app->getContainer();

$container['view'] = new \Slim\Views\PhpRenderer('resources/views/');

$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO('mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};



$app->get('/', function (Request $request, Response $response, array $args) {
    $responde = $this->view->render($response, 'template.phtml');
    return $response; 
});

$app->post('/novafruta', function (Request $request, Response $response) {
    $dados = $request->getParsedBody();
    $dados_fruta = [];
    $dados_fruta['nome'] = filter_var($data['nome'], FILTER_SANITIZE_STRING);
    $dados_fruta['preco'] = filter_var($data['preco'], FILTER_SANITIZE_STRING);
    $dados_fruta['quantidade'] = filter_var($data['quantidade'], FILTER_SANITIZE_STRING);
    $dados_fruta['tipo_fruta_id'] = filter_var($data['tipo_fruta_id'], FILTER_SANITIZE_STRING);
});


$app->run();


?>