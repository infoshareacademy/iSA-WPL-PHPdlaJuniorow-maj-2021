<?php declare(strict_types=1);

namespace App\Infrastructure\Persistence\AppTwo;

use App\Domain\Ping\AppPingRepository;
use App\Domain\Ping\AppPingResponse;
use App\Domain\Ping\AppTwoPing\AppTwoPingResponse;
use App\Infrastructure\ApiClients\AppTwoClient\AppTwoClient;

class AppTwoQueryRepository implements AppPingRepository
{
    private AppTwoClient $client;

    public function __construct(AppTwoClient $client)
    {
        $this->client = $client;
    }

    public function ping(): AppPingResponse
    {
        $response = $this->client->getRequest(AppTwoUrlConst::PING);
        return new AppTwoPingResponse((string) $response->getBody());
    }

}