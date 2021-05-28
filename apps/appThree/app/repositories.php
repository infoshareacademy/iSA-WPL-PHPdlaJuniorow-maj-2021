<?php
declare(strict_types=1);

use App\Domain\Order\OrderRepository;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        OrderRepository::class => function (ContainerInterface $c) {
            return new OrderRepository($c->get('db'));
        },
    ]);

};
