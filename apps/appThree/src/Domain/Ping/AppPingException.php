<?php declare(strict_types=1);

namespace App\Domain\Ping\AppThreePing;

use App\Domain\DomainException\DomainRecordNotFoundException;

class AppPingException extends DomainRecordNotFoundException
{
    public $message = 'AppPing error respond';
}