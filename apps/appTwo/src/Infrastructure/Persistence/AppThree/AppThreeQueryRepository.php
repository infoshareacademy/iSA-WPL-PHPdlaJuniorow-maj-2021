<?php declare(strict_types=1);

namespace App\Infrastructure\Persistence\AppThree;

use App\Domain\Ping\AppPingRepository;
use App\Domain\Ping\AppPingResponse;
use App\Domain\Ping\AppThreePing\AppThreePingResponse;
use App\Infrastructure\ApiClients\AppThreeClient\AppThreeClient;

class AppThreeQueryRepository implements AppPingRepository
{
    private AppThreeClient $client;

    public function __construct(AppThreeClient $client)
    {
        $this->client = $client;
    }

    public function ping(): AppPingResponse
    {
        $response = $this->client->getRequest(AppThreeUrlConst::PING);
        return new AppThreePingResponse((string) $response->getBody());
    }

}