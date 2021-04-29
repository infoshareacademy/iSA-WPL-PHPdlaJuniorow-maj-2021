<?php
declare(strict_types=1);

use App\Application\Actions\PingExternalApp\AppOne\AppOnePingAction;
use App\Application\Actions\PingExternalApp\AppThree\AppThreePingAction;
use App\Application\Actions\User\ListUsersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Pong App2');
        return $response;
    });

    $app->group('/users', function (Group $group) {
        $group->get('', ListUsersAction::class);
        $group->get('/{id}', ViewUserAction::class);
    });

    $app->group('/app-three', function (Group $group) {
        $group->get('/ping', AppThreePingAction::class);
    });
    $app->group('/app-one', function (Group $group) {
        $group->get('/ping', AppOnePingAction::class);
    });
};
