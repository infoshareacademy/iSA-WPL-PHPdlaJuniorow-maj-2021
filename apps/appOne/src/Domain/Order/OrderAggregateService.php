<?php declare(strict_types=1);

namespace App\Domain\Order;

use App\Domain\Product\ProductService;

/**
 * Class OrderService
 */
class OrderAggregateService
{
    /**
     * @var OrderService
     */
    private $orderService;
    /**
     * @var ProductService
     */
    private $productService;

    public function __construct(OrderService $orderService, ProductService $productService)
    {
        $this->orderService = $orderService;
        $this->productService = $productService;
    }

    public function getOrderWithProductsAndDetails(int $id): array
    {
        // pobieramy pelne informacje o zamowieniu
        $order = $this->orderService->getOrder($id);

        // pusta tablica do ktorej bedziemy zbierac dane
        $productDataList = [];
        foreach ($order['productsIdList'] as $productId) {
            // pobieramy pelne informacje o produkcie
            // dodajemy dane produktu do listy
            array_push($productDataList, $this->productService->getProduct($productId));
        }

        // inicjalizujemy zmienna, do ktorej bedziemy zbierac sume
        $orderSum = 0;
        // sumujemy wartosc produktow
        foreach ($productDataList as $productData) {
            $orderSum += $productData['cena'];
        }

        return [
            'client' => $order['details']['client'],
            'order_status' => $order['details']['status'],
            'product_list' => $productDataList,
            'price_total' => $orderSum,
        ];
    }
}
