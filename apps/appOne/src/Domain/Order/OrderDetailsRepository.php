<?php declare(strict_types=1);

namespace App\Domain\Order;

use Exception;

/**
 * Class OrderRepository
 */
class OrderDetailsRepository
{
    public function getOrderDetails(int $id): array
    {
        $usersOrdersDetails = [
            101 => ['client' => 'Pan Karol', 'status' => 'paid'],
            102 => ['client' => 'Pan Pawel', 'status' => 'to pay'],
            103 => ['client' => 'Pan Michal', 'status' => 'paid'],
            104 => ['client' => 'Pan Dariusz', 'status' => 'to pay'],
            105 => ['client' => 'Pan Maciej', 'status' => 'cancelled']
        ];

        if (false === array_key_exists($id, $usersOrdersDetails)) {
            throw new Exception('Id out of range (101-105)');
        }

        return $usersOrdersDetails[$id];
    }
}
