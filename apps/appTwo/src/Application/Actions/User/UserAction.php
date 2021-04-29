<?php
declare(strict_types=1);

namespace App\Application\Actions\User;

use App\Application\Actions\Action;
use App\Domain\User\UserCommandRepository;
use App\Domain\User\UserQueryRepository;
use App\Domain\User\UserRepository;
use Psr\Log\LoggerInterface;

abstract class UserAction extends Action
{
    protected UserQueryRepository $userRepository;
    protected UserCommandRepository $userCommandRepository;

    public function __construct(LoggerInterface $logger,
                                UserQueryRepository $userRepository,
                                UserCommandRepository $userCommandRepository
    ) {
        parent::__construct($logger);
        $this->userRepository = $userRepository;
        $this->userCommandRepository = $userCommandRepository;
    }
}
