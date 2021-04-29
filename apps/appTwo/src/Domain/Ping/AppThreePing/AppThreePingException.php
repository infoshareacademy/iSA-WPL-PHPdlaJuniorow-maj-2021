<?php declare(strict_types=1);

namespace App\Domain\Ping\AppThreePing;

use App\Domain\DomainException\DomainRecordNotFoundException;

class AppThreePingException extends DomainRecordNotFoundException
{
    public $message = 'AppThree error respond';
}