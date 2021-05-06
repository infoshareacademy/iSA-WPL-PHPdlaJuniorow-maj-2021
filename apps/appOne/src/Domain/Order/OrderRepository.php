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
            1 => [1,2,3],
            2 => [3,2,5],
            3 => [5,4],
            4 => [1,3,5,2,4],
            5 => [5]
        ];

        if (false === array_key_exists($id, $usersOrdersLists)) {
            throw new Exception('Id out of range (1-5)');
        }

        return $usersOrdersLists[$id];
    }
}
