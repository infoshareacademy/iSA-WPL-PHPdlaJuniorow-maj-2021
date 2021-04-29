<?php
declare(strict_types=1);

use App\Application\Settings\Settings;
use App\Application\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Logger;

return function (ContainerBuilder $containerBuilder) {

    // Global Settings Object
    $containerBuilder->addDefinitions([
        SettingsInterface::class => function () {
            return new Settings([
                'displayErrorDetails' => true, // Should be set to false in production
                'logError'            => false,
                'logErrorDetails'     => false,
                'logger' => [
                    'name' => 'slim-app',
                    'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                    'level' => Logger::DEBUG,
                ],
                'db' => [
                    'host'   => getenv('DB_HOST'),
                    'port'   => getenv('DB_PORT'),
                    'user'   => getenv('DB_USERNAME'),
                    'pass'   => getenv('DB_PASSWORD'),
                    'dbname' => getenv('DB_NAME_APP_TWO'),
                    'driver' => getenv('DB_DRIVER'),
                ],
                'appOne' => [
                    'baseUri' =>  getenv('APP_ONE_HOST')
                ],
                'appThree' => [
                    'baseUri' => getenv('APP_THREE_HOST')
                ]
            ]);
        }
    ]);
};
