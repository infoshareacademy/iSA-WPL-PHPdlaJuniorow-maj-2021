<?php declare(strict_types=1);

namespace App\Application\Actions\CreateOrder;

use App\Application\Actions\Action;
use App\Domain\Order\OrderService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class CreateOrder extends Action
{

    private OrderService $orderService;
    
    public function __construct(LoggerInterface $logger, OrderService $orderService) {

        parent::__construct($logger);
        $this->orderService = $orderService;
    }

    public function action(): Response
    {
        $payload = $this->getFormData();

        return $this->respondWithData($data);
    }
}
