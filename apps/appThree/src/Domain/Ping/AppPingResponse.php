<?php declare(strict_types=1);

namespace App\Domain\Ping;

abstract class AppPingResponse
{
    private string $message;

    public function __construct(string $message)
    {
        $this->message = $message;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function jsonSerialize(): array
    {
        return [
            'message' => $this->message
        ];
    }
}