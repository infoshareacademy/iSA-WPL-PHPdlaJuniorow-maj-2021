<?php
declare(strict_types=1);

use App\Application\Actions\PingExternalApp\AppOne\AppOnePingAction;
use App\Application\Actions\PingExternalApp\AppTwo\AppTwoPingAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Application\Actions\Order\GetOrderAction;
use App\Application\Actions\Order\ListOrdersAction;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Pong App3');
        return $response;
    });

    $app->group('/app-two', function (Group $group) {
        $group->get('/ping', AppTwoPingAction::class);
    });
    $app->group('/app-one', function (Group $group) {
        $group->get('/ping', AppOnePingAction::class);
    });

    $app->group('/api/v1/orders', function (Group $group) {
        $group->get('', ListOrdersAction::class);
        $group->get('/{id}', GetOrderAction::class);
    });
};
