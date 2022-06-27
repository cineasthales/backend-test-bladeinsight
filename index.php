<?php

if (!array_key_exists('PATH_INFO', $_SERVER)) {
    notFound();
}

$allowed_methods = ['GET', 'POST', 'PUT', 'DELETE'];
$methods_with_id = ['PUT', 'DELETE'];

$method = $_SERVER['REQUEST_METHOD'];

if ((!in_array($method, $allowed_methods) ||
    (in_array($method, $methods_with_id) && !array_key_exists('id', $_GET)))) {
    notFound();
}

$config_path = __DIR__ . '/src/Config/';
require_once $config_path . 'Autoload.php';

$resource = $_SERVER['PATH_INFO'];
$routes = require_once $config_path . 'Routes.php';

if (!array_key_exists($resource, $routes)) {
    notFound();
}

$controller = new $routes[$resource];

$response = false;

switch($method) {
    case 'GET':
        if (!array_key_exists('id', $_GET)) {
            $response = $controller->index();
        } else {
            $response = $controller->show($_GET['id']);
        }
        break;
    case 'POST':
        $response = $controller->store(json_decode(file_get_contents('php://input'), true));
        break;
    case 'PUT':
        $response = $controller->update($_GET['id'], json_decode(file_get_contents('php://input'), true));
        break;
    case 'DELETE':
        $response = $controller->destroy($_GET['id']);
}

echo json_encode($response);

function notFound() {
    http_response_code(404);
    exit();
}