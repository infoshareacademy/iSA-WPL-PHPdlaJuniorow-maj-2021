<?php

declare(strict_types=1);

namespace App\Domain\HotelDescription;

interface HotelDescriptionRepository
{
    /**
     * @return HotelDescription[]
     */
    public function findAll(): array;

    public function find(string $identifier): ?HotelDescription;

    public function delete(string $identifier): void;

    public function create(string $identifier, string $name, string $description): void;

    public function update(string $identifier, string $name, string $description): void;
}
