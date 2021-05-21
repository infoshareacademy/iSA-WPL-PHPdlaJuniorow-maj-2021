<?php
declare(strict_types=1);

use App\Domain;
use App\Infrastructure\Persistence;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        Domain\Order\OrderRepository::class => function (ContainerInterface $c) {
            return new Persistence\Order\OrderRepository($c->get('db'));
        },
    ]);
};
