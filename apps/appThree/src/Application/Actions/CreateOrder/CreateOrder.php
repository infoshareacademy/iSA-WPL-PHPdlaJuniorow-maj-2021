<?php declare(strict_types=1);

namespace App\Application\Actions\CreateOrder;

use App\Application\Actions\Action;
use App\Domain\Logger\LogCreateCommand;
use App\Domain\Logger\LoggerService;
use App\Domain\Order\OrderCreateCommand;
use App\Domain\Order\OrderService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class CreateOrder extends Action
{
    private OrderService $orderService;
    private LoggerService $loggerService;

    public function __construct(LoggerInterface $logger, OrderService $orderService, LoggerService $loggerService)
    {

        parent::__construct($logger);
        $this->orderService = $orderService;
        $this->loggerService = $loggerService;
    }

    public function action(): Response
    {
        $payload = $this->getFormData();
        try {
            $orderCreateCommand = new OrderCreateCommand(
                $payload['client'],
                $payload['status'],
                $payload['price'],
                $payload['currency']
            );
            $data = $this->orderService->create($orderCreateCommand);
        } catch (\Throwable $exc) {
            $this->loggerService->create(new LogCreateCommand(\json_encode($payload), $exc->getMessage()));
            return $this->respondWithData($exc->getMessage(), 500);
        }

        return $this->respondWithData($data);
    }
}
