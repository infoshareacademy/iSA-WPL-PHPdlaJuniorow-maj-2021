<?php declare(strict_types=1);

namespace App\Application\Actions\GetOrder;

use App\Application\Actions\Action;
use App\Domain\Order\OrderService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class GetOrder extends Action
{

    private OrderService $orderService;
    
    public function __construct(LoggerInterface $logger, OrderService $orderService) {

        parent::__construct($logger);
        $this->orderService = $orderService;
    }

    public function action(): Response
    {
        $orderId = (int)$this->args['id'];

        return $this->respondWithData($data);
    }
}
