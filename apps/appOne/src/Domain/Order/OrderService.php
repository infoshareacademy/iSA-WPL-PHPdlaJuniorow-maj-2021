<?php declare(strict_types=1);

namespace App\Domain\Order;

/**
 * Class OrderService
 */
class OrderService
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var OrderDetailsRepository
     */
    private $orderDetailsRepository;

    public function __construct(OrderRepository $orderRepository, OrderDetailsRepository $orderDetailsRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->orderDetailsRepository = $orderDetailsRepository;
    }

    public function getOrder(int $id)
    {
        return [
            'details' => $this->orderDetailsRepository->getOrderDetails($id),
            'productsIdList' => $this->orderRepository->getProductIdListByOrderId($id)
        ];
    }
}
