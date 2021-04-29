<?php declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\DomainException\DomainRecordNotFoundException;

class UserDuplicateCreateException extends DomainRecordNotFoundException
{
    public $message = 'User not created. Username duplication';
}
