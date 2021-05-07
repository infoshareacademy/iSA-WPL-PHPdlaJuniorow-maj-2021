<?php declare(strict_types=1);

namespace App\Application\Actions\DisplayOrder;

use App\Application\Actions\Action;
use App\Domain\Order\OrderRepository;
use App\Domain\Product\ProductRepository;
use Psr\Http\Message\ResponseInterface as Response;

/**
 * Class DisplayOrder
 *
 * @package App\Application\Actions\DisplayCart
 */
class DisplayOrder extends Action
{
    public function action(): Response
    {
        // inicjalizujemy zrodlo danych
        $orderRepository = new OrderRepository();
        // pobieramy liste produktow ze zrodla danych
        $productIdList = $orderRepository->getProductIdListByOrderId((int)$this->args['id']);

        // pusta tablica do ktorej bedziemy zbierac dane
        $productDataList = [];
        // inicjalizujemy zrodlo danych
        $productRepository = new ProductRepository();
        foreach ($productIdList as $productId) {
            // pobieramy informacje o kazdym produkcie ze zrodla danych
            $productData = $productRepository->getProductDataById($productId);
            // dodajemy dane produktu do listy
            array_push($productDataList, $productData);
        }

        // inicjalizujemy zmienna, do ktorej bedziemy zbierac sume
        $orderSum = 0;
        // sumujemy wartosc produktow
        foreach ($productDataList as $productData) {
            $orderSum += $productData['price'];
        }

        return $this->respondWithData([
            'produkty' => $productDataList,
            'suma' => $orderSum,
        ]);
    }
}
