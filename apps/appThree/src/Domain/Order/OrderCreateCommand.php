<?php

declare(strict_types=1);

namespace App\Domain\Order;

class OrderCreateCommand
{

    private string $client;
    private string $status;
    private int $price_amount;
    private string $currency;
    private array $errors = [];

    public function __construct(string $client, string $status, int $price_amount, string $currency)
    {
        $this->client = $client;
        $this->status = $status;
        $this->price_amount = $price_amount;
        $this->currency = $currency;
    }

    public function isValid()
    {
        if ($this->price_amount < 0) {
            $this->errors['price_amount'] = 'Niepoprawna kwota zamówienia';
        }
        if (\strlen($this->currency) !== 3) {
            $this->errors['currency'] = 'Nieznany format waluty';
        }
        if (count($this->errors) > 0) {
            return false;
        }
        return true;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return string
     */
    public function getClient(): string
    {
        return $this->client;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getPriceAmount(): int
    {
        return $this->price_amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }
}
