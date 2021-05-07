<?php declare(strict_types=1);

namespace App\Application\Actions\DisplayAllOrders;

use App\Application\Actions\Action;
use App\Domain\Order\OrderAggregateService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class DisplayAllOrders extends Action
{
    /**
     * @var OrderAggregateService
     */
    private $orderAggregateService;

    public function __construct(LoggerInterface $logger, OrderAggregateService $orderAggregateService) {
        parent::__construct($logger);
        $this->orderAggregateService = $orderAggregateService;
    }

    public function action(): Response
    {
        $orders = [
            $this->orderAggregateService->getOrderWithProductsAndDetails(101),
            $this->orderAggregateService->getOrderWithProductsAndDetails(102),
            $this->orderAggregateService->getOrderWithProductsAndDetails(103),
            $this->orderAggregateService->getOrderWithProductsAndDetails(104),
            $this->orderAggregateService->getOrderWithProductsAndDetails(105),
        ];
        return $this->respondWithData($orders);
    }
}
