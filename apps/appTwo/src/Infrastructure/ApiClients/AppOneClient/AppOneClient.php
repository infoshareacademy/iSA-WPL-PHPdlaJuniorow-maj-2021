<?php declare(strict_types=1);

namespace App\Infrastructure\ApiClients\AppOneClient;

use App\Domain\Ping\AppOnePing\AppOnePingException;
use App\Infrastructure\ApiClients\AbstractClient;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class AppOneClient extends AbstractClient
{
    public function __construct(AppOneConfig $config)
    {
        $this->baseUrl = $config->getBaseUrl();
        parent::__construct($config->toGuzzleConfigArray());
    }

    public function getRequest(string $url) : ResponseInterface
    {
        try {
            return $this->request('GET', $this->prepareUrl($url));
        } catch (GuzzleException $exception) {
            throw new AppOnePingException();
        }
    }

    public function postRequest(string $url, array $data = []) : ResponseInterface
    {
        return $this->request('POST', $this->prepareUrl($url), $data);
    }
}