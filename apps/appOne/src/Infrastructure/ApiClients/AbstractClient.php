<?php declare(strict_types=1);

namespace App\Infrastructure\ApiClients;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Throwable;

abstract class AbstractClient extends Client
{
    protected string $baseUrl;

    public function request($method, $uri = '', array $options = []): ResponseInterface
    {
        if (!isset($options['headers'])) {
            $options['headers'] = [];
        }

        if (!isset($options['headers']['Content-Type'])) {
            $options['headers']['Content-Type'] = 'application/json';
        }

        try {
            return parent::request($method, $uri, $options);
        } catch (Throwable $exception) {
            throw $exception;
        }
    }

    protected function prepareUrl(string $url): string
    {
        return $this->baseUrl . $url;
    }
}