<?php
declare(strict_types=1);

use App\Domain\User\UserCommandRepository;
use App\Domain\User\UserQueryRepository;
use App\Infrastructure\Persistence\User\CommandUserRepository;
use App\Infrastructure\Persistence\User\QueryUserRepository;
use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        UserQueryRepository::class => function (ContainerInterface $c) {
            return new QueryUserRepository($c->get('db'));
        },
        UserCommandRepository::class => function (ContainerInterface $c) {
            return new CommandUserRepository($c->get('db'));
        },
    ]);
};
