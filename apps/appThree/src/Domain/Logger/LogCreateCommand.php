<?php

declare(strict_types=1);

namespace App\Domain\Logger;

class LogCreateCommand
{

    private string $body;
    private string $message;

    public function __construct(string $body, string $message)
    {
        $this->body = $body;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }
}
