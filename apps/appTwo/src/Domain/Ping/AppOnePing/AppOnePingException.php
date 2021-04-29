<?php declare(strict_types=1);

namespace App\Domain\Ping\AppOnePing;

use App\Domain\DomainException\DomainRecordNotFoundException;

class AppOnePingException extends DomainRecordNotFoundException
{
    public $message = 'AppOne error respond';
}