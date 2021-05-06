<?php declare(strict_types=1);

namespace App\Domain\Product;

use Exception;

/**
 * Class ProductRepository
 *
 * @package App\Domain\Ping
 */
class ProductDescriptionRepository
{
    public function getProductDescriptionById(int $id): string {
        $productList = [
            1 => 'Czarne z bialym paskiem i napisem KLAP.',
            2 => '50x100cm Niebieski z nadrukiem pelikana.',
            3 => 'Okulary ze srebrna ramka.',
            4 => 'Parasol duzy, zolto-czerwony.',
            5 => 'Najnowsze wydanie tygodnika Plazowicz.',
        ];

        if (false === array_key_exists($id, $productList)) {
            throw new Exception('Id out of range (1-5)');
        }

        return $productList[$id];
    }
}
