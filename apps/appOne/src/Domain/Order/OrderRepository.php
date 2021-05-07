<?php declare(strict_types=1);

namespace App\Domain\Order;

use Exception;

/**
 * Class OrderRepository
 */
class OrderRepository
{
    public function getProductIdListByOrderId(int $id): array
    {
        $usersOrdersLists = [
            101 => [1,2,3],
            102 => [3,2,5],
            103 => [5,4],
            104 => [1,3,5,2,4],
            105 => [5]
        ];

        if (false === array_key_exists($id, $usersOrdersLists)) {
            throw new Exception('Id out of range (101-105)');
        }

        return $usersOrdersLists[$id];
    }
}
