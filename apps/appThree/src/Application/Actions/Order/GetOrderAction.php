<?php

declare(strict_types=1);

namespace App\Application\Actions\Order;

use App\Domain\Order\Order;
use Psr\Http\Message\ResponseInterface as Response;

class GetOrderAction extends OrderAction
{
    protected function action(): Response
    {
        $order = $this->orderRepository->find((int) $this->request->getAttribute('id'));

        if (!$order instanceof Order) {
            return $this->jsonResponse(null, 404);
        }

        return $this->jsonResponse($order);
    }
}
