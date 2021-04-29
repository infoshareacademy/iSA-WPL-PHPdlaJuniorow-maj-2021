<?php
declare(strict_types=1);

namespace App\Application\Actions\User;

use App\Domain\User\User;
use Psr\Http\Message\ResponseInterface as Response;

class AddUsersAction extends UserAction
{
    protected function action(): Response
    {
        $userData = $this->getPostRequestBodyAsArray();
        $id = $this->userCommandRepository->create(
            new User(
                null,
                $userData['username'],
                $userData['firstname'],
                $userData['lastname']
            )
        );
        $this->logger->info("Dodano użytkownika " . $id );

        return $this->respondWithData([
            'id' => $id
        ]);
    }
}
