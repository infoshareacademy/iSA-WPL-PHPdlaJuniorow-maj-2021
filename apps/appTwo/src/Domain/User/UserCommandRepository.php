<?php
declare(strict_types=1);

namespace App\Domain\User;

interface UserCommandRepository
{
    /**
     * @return int
     */
    public function create(User $user): int;


}
