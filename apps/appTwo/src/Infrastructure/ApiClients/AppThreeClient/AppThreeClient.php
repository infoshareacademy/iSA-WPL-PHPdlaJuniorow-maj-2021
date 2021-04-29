<?php declare(strict_types=1);

namespace App\Infrastructure\ApiClients\AppThreeClient;

use App\Domain\Ping\AppThreePing\AppThreePingException;
use App\Infrastructure\ApiClients\AbstractClient;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class AppThreeClient extends AbstractClient
{
    public function __construct(AppThreeConfig $config)
    {
        $this->baseUrl = $config->getBaseUrl();
        parent::__construct($config->toGuzzleConfigArray());
    }

    public function getRequest(string $url) : ResponseInterface
    {
        try {
            return $this->request('GET', $this->prepareUrl($url));
        } catch (GuzzleException $exception) {
            throw new AppThreePingException();
        }
    }

    public function postRequest(string $url, array $data = []) : ResponseInterface
    {
        return $this->request('POST', $this->prepareUrl($url), $data);
    }
}