<?php

require __DIR__ . '/../vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;


$app = AppFactory::create();
$taskManager = new \Task\TaskManager(new \Task\FileManager());

$app->get('/tasks{slash:[/]?}', function (Request $request, Response $response, array $args) use ($taskManager) {
    $response->getBody()->write(
        json_encode($taskManager->all())
    );
    $response = $response->withHeader('Content-type', 'application/json');

    return $response;
});

$app->get('/tasks/{id}{slash:[/]?}', function (Request $request, Response $response, array $args) use ($taskManager) {
    $response->getBody()->write(
        json_encode($taskManager->get($args['id']))
    );
    $response = $response->withHeader('Content-type', 'application/json');

    return $response;
});

$app->post('/tasks/', function (Request $request, Response $response, array $args) use ($taskManager) {
    $taskManager->create(new \Task\Task($request->getParsedBody()));

    return $response->withStatus(201);
});

$app->put('/tasks/{id}{slash:[/]?}', function (Request $request, Response $response, array $args) use ($taskManager) {
    $taskManager->update($args['id'], new \Task\Task($request->getParsedBody()));

    return $response;
});


$app->delete('/tasks/{id}{slash:[/]?}', function (Request $request, Response $response, array $args) use ($taskManager) {
    $taskManager->delete($args['id']);

    return $response;
});


$app->run();