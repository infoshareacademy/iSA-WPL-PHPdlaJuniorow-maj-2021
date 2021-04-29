<?php declare(strict_types=1);

namespace App\Domain\AppThreePing;

use App\Domain\DomainException\DomainRecordNotFoundException;

class AppTwoPingException extends DomainRecordNotFoundException
{
    public $message = 'AppTwo error respond';
}