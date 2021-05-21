<?php

declare(strict_types=1);

namespace App\Domain\Order;

interface OrderRepository
{
    /**
     * @return Order[]
     */
    public function findAll(): array;

    public function find(int $id): ?Order;
}
