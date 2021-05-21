<?php

declare(strict_types=1);

namespace App\Domain\Order;

use DateTime;
use JsonSerializable;

class Order implements JsonSerializable
{
    private int $id;

    private string $hotelName;

    private DateTime $startsAt;

    private DateTime $endsAt;

    private string $country;

    private string $purchaser;

    private float $price;

    public function __construct(
        int $id,
        string $hotelName,
        DateTime $startsAt,
        DateTime $endsAt,
        string $country,
        string $purchaser,
        float $price
    ) {
        $this->id = $id;
        $this->hotelName = $hotelName;
        $this->startsAt = $startsAt;
        $this->endsAt = $endsAt;
        $this->country = $country;
        $this->purchaser = $purchaser;
        $this->price = $price;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'hotel_name' => $this->hotelName,
            'starts_at' => $this->startsAt->format('Y-m-d'),
            'ends_at' => $this->endsAt->format('Y-m-d'),
            'country' => $this->country,
            'purchaser' => $this->purchaser,
            'price' => $this->price,
        ];
    }
}
