<?php

declare(strict_types=1);

use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use App\Application\Actions\User\ViewUserAction;
use App\Application\Actions\User\ListUsersAction;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
      
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
        $group->post('', function (Request $request, Response $response) {
            $response->getBody()->write('Create user');
            return $response;
        });
        $group->put('/{id}', function (Request $request, Response $response, $args) {
            $response->getBody()->write('Update user ' . $args['id']);
            return $response;
        });
    });

 

    $app->get('/tasks', function (Request $request, Response $response) {
        $response->getBody()->write('List of tasks');
        return $response;
    });

    $app->get('/tasks/{id}', function (Request $request, Response $response, $args) {
        $response->getBody()->write('Task ' . $args['id']);
        return $response;
    });

    $app->post('/tasks', function (Request $request, Response $response) {
        $response->getBody()->write('Create task');
        return $response;
    });

    $app->put('/tasks/{id}', function (Request $request, Response $response, $args) {
        $response->getBody()->write('Update task ' . $args['id']);
        return $response;
    });
    
};
