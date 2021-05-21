<?php

declare(strict_types=1);

namespace App\Application\Actions\Order;

use Psr\Http\Message\ResponseInterface as Response;

class ListOrdersAction extends OrderAction
{
    protected function action(): Response
    {
        return $this->jsonResponse($this->orderRepository->findAll());
    }
}
