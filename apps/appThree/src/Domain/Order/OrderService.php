<?php declare(strict_types=1);

namespace App\Domain\Order;

class OrderService
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

}
