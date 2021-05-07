<?php declare(strict_types=1);

namespace App\Application\Actions\DisplayOrder;

use App\Application\Actions\Action;
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
        // obsluga


        return $this->respondWithData([
            'produkty' => [],
            'suma' => 0,
        ]);
    }
}
