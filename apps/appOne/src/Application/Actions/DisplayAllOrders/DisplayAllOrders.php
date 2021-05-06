<?php declare(strict_types=1);

namespace App\Application\Actions\DisplayAllOrders;

use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class DisplayAllOrders extends Action
{
    public function action(): Response
    {
        /*
         * [
         *   order_id: 1,
         *   ...
         * ],
         * [
         *   order_id: 2,
         *   ...
         * ],
         * ...
         */
        return $this->respondWithData([]);
    }
}
