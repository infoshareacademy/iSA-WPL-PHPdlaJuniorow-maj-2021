<?php declare(strict_types=1);

namespace App\Application\Actions\DisplayOrder;

use App\Application\Actions\Action;
use App\Domain\Order\OrderAggregateService;
use App\Domain\Order\OrderDetailsRepository;
use App\Domain\Order\OrderRepository;
use App\Domain\Order\OrderService;
use App\Domain\Product\ProductDescriptionRepository;
use App\Domain\Product\ProductRepository;
use App\Domain\Product\ProductService;
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

        // inicjalizujemy serwisy wraz z ich zaleznosciami
        $orderService = new OrderService(new OrderRepository(), new OrderDetailsRepository());
        $productService = new ProductService(new ProductRepository(), new ProductDescriptionRepository());

        $orderAggregateService = new OrderAggregateService($orderService, $productService);
        $order = $orderAggregateService->getOrderWithProductsAndDetails($orderId);

        return $this->respondWithData([
            'zamawiajacy' => $order['client'],
            'status' => $order['order_status'],
            'produkty' => $order['product_list'],
            'suma' => $order['price_total'],
        ]);
    }
}
