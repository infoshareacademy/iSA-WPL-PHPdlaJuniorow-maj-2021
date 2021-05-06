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
            1 => ['client' => 'Pan Karol', 'status' => 'paid'],
            2 => ['client' => 'Pan Pawel', 'status' => 'to pay'],
            3 => ['client' => 'Pan Michal', 'status' => 'paid'],
            4 => ['client' => 'Pan Dariusz', 'status' => 'to pay'],
            5 => ['client' => 'Pan Maciej', 'status' => 'cancelled']
        ];

        if (false === array_key_exists($id, $usersOrdersDetails)) {
            throw new Exception('Id out of range (1-5)');
        }

        return $usersOrdersDetails[$id];
    }
}
