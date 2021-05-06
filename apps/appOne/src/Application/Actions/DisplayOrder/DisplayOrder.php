<?php declare(strict_types=1);

namespace App\Application\Actions\DisplayOrder;

use App\Application\Actions\Action;
use App\Domain\Order\OrderDetailsRepository;
use App\Domain\Order\OrderRepository;
use App\Domain\Product\ProductDescriptionRepository;
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
        $orderId = (int)$this->args['id'];

        // inicjalizujemy zrodlo danych
        $orderRepository = new OrderRepository();
        // pobieramy liste produktow ze zrodla danych
        $productIdList = $orderRepository->getProductIdListByOrderId($orderId);

        // pusta tablica do ktorej bedziemy zbierac dane
        $productDataList = [];
        // inicjalizujemy zrodlo danych
        $productRepository = new ProductRepository();
        $productDescriptionRepository = new ProductDescriptionRepository();
        foreach ($productIdList as $productId) {
            // pobieramy informacje o kazdym produkcie ze zrodla danych
            $productData = $productRepository->getProductDataById($productId);
            // pobieramy opis produktu z innego zrodla
            $productDescription = $productDescriptionRepository->getProductDescriptionById($productId);
            $product = [
                'nazwa' => $productData['name'],
                'cena' => $productData['price'],
                'opis' => $productDescription,
            ];
            // dodajemy dane produktu do listy
            array_push($productDataList, $product);
        }

        // inicjalizujemy zmienna, do ktorej bedziemy zbierac sume
        $orderSum = 0;
        // sumujemy wartosc produktow
        foreach ($productDataList as $productData) {
            $orderSum += $productData['cena'];
        }

        // pobieramy dane zamowienia
        // inicjalizujemy nowe zrodlo danych
        $orderDetailsRepository = new OrderDetailsRepository();
        $orderDetails = $orderDetailsRepository->getOrderDetails($orderId);

        return $this->respondWithData([
            'zamawiajacy' => $orderDetails['client'],
            'status' => $orderDetails['status'],
            'produkty' => $productDataList,
            'suma' => $orderSum,
            'suma w euro' => ''
        ]);
    }
}
