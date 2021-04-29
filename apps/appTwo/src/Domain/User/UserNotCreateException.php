<?php declare(strict_types=1);

namespace App\Domain\User;

use App\Domain\DomainException\DomainRecordNotFoundException;

class UserNotCreateException extends DomainRecordNotFoundException
{
    public $message = 'The user data you send where not saved';
}
