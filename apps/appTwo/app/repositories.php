<?php
declare(strict_types=1);

use App\Domain;
use App\Infrastructure\Persistence;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        Domain\User\UserQueryRepository::class => function (ContainerInterface $c) {
            return new App\Infrastructure\Persistence\User\QueryUserRepository($c->get('db'));
        },
        Domain\User\UserCommandRepository::class => function (ContainerInterface $c) {
            return new App\Infrastructure\Persistence\User\CommandUserRepository($c->get('db'));
        },
        Domain\HotelDescription\HotelDescriptionRepository::class => function (ContainerInterface $c) {
            return new App\Infrastructure\Persistence\HotelDescription\HotelDescriptionRepository($c->get('db'));
        },
    ]);
};
