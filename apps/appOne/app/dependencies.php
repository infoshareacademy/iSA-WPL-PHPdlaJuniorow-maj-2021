<?php
declare(strict_types=1);

use App\Application\Settings\SettingsInterface;
use App\Infrastructure\ApiClients\AppThreeClient\AppThreeClient;
use App\Infrastructure\ApiClients\AppThreeClient\AppThreeConfig;
use App\Infrastructure\ApiClients\AppTwoClient\AppTwoClient;
use App\Infrastructure\ApiClients\AppTwoClient\AppTwoConfig;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;


return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        'db' => function (ContainerInterface $c) {
            $db = ($c->get(SettingsInterface::class))->get('db');

            return new Pdo(
                $db['driver']
                . ':host=' . $db['host']
                . ';port=' . $db['port']
                . ';dbname=' . $db['dbname']
                . ';user=' . $db['user']
                . ';password=' . $db['pass']
            );
        },
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);

            $loggerSettings = $settings->get('logger');
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
        AppTwoClient::class => function (ContainerInterface $c) {
            $settings = ($c->get(SettingsInterface::class))->get('appTwo');
            return new AppTwoClient(new AppTwoConfig($settings));
        },
        AppThreeClient::class => function (ContainerInterface $c) {
            $settings = ($c->get(SettingsInterface::class))->get('appThree');
            return new AppThreeClient(new AppThreeConfig($settings));
        },
    ]);
};
