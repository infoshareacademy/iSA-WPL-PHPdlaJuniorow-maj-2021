<?php declare(strict_types=1);

namespace App\Infrastructure\ApiClients\AppTwoClient;

class AppTwoConfig
{
    private string $baseUrl;

    public function __construct(array $settings)
    {
        $this->baseUrl = $settings['baseUri'];
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    public function toGuzzleConfigArray(): array
    {
        return [
            'base_url' => $this->getBaseUrl()
        ];
    }
}