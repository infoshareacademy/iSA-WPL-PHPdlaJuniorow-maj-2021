<?php
declare(strict_types=1);

use App\Application\Settings\SettingsInterface;
use App\Domain\Logger\LoggerRepository;
use App\Domain\Logger\LoggerService;
use App\Domain\Order\OrderRepository;
use App\Domain\Order\OrderService;
use App\Infrastructure\ApiClients\AppOneClient\AppOneClient;
use App\Infrastructure\ApiClients\AppOneClient\AppOneConfig;
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
            $pdo = new Pdo(
                $db['driver']
                . ':host=' . $db['host']
                . ';port=' . $db['port']
                . ';dbname=' . $db['dbname']
                . ';user=' . $db['user']
                . ';password=' . $db['pass']
            );

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL);
            $pdo->setAttribute(PDO::ATTR_PERSISTENT, false);

            return $pdo;
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
        AppOneClient::class => function (ContainerInterface $c) {
            $settings = ($c->get(SettingsInterface::class))->get('appOne');
            return new AppOneClient(new AppOneConfig($settings));
        },
        OrderService::class => function (ContainerInterface $c) {
            return new OrderService($c->get(OrderRepository::class));
        },
        LoggerService::class => function (ContainerInterface $c) {
            return new LoggerService($c->get(LoggerRepository::class));
        },
    ]);
};
