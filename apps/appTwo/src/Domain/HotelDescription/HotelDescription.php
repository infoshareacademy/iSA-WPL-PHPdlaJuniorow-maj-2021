<?php

declare(strict_types=1);

namespace App\Domain\HotelDescription;

use JsonSerializable;

class HotelDescription implements JsonSerializable
{
    private string $identifier;
    private string $name;
    private string $description;

    public function __construct(string $identifier, string $name, string $description)
    {
        $this->identifier = $identifier;
        $this->name = $name;
        $this->description = $description;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}
