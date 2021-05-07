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

        // pusta tablica do ktorej bedziemy zbierac dane


        // inicjalizujemy zmienna, do ktorej bedziemy zbierac sume

        return [
            // 'client' => ...,
            // 'order_status' => ...
            // 'product_list' => ...
            // 'price_total' => ...
        ];
    }
}
