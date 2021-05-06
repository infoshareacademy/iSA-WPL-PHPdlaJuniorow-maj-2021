<?php declare(strict_types=1);

namespace App\Domain\Product;

use Exception;

/**
 * Class ProductRepository
 *
 * @package App\Domain\Ping
 */
class ProductRepository
{
    public function getProductDataById(int $id): array {
        $productList = [
            1 => [
                'name' => 'Klapki',
                'price' => 5
            ],
            2 => [
                'name' => 'Recznik',
                'price' => 10
            ],
            3 => [
                'name' => 'Okulary',
                'price' => 5
            ],
            4 => [
                'name' => 'Parasol',
                'price' => 12
            ],
            5 => [
                'name' => 'Gazeta',
                'price' => 3
            ],
        ];

        if (false === array_key_exists($id, $productList)) {
            throw new Exception('Id out of range (1-5)');
        }

        return $productList[$id];
    }
}
