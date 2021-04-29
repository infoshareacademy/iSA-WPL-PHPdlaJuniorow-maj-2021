<?php declare(strict_types=1);

namespace App\Infrastructure\Persistence\AppOne;

use App\Domain\Ping\AppPingRepository;
use App\Domain\Ping\AppPingResponse;
use App\Domain\Ping\AppOnePing\AppOnePingResponse;
use App\Infrastructure\ApiClients\AppOneClient\AppOneClient;

class AppOneQueryRepository implements AppPingRepository
{
    private AppOneClient $client;

    public function __construct(AppOneClient $client)
    {
        $this->client = $client;
    }

    public function ping(): AppPingResponse
    {
        $response = $this->client->getRequest(AppOneUrlConst::PING);
        return new AppOnePingResponse((string) $response->getBody());
    }

}