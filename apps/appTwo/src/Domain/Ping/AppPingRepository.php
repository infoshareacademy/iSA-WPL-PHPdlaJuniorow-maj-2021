<?php declare(strict_types=1);

namespace App\Domain\Ping;

interface AppPingRepository
{
    public function ping() : AppPingResponse;
}