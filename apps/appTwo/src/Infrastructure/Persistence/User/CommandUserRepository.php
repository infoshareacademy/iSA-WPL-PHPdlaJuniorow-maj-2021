<?php declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use App\Domain\User\User;
use App\Domain\User\UserCommandRepository;
use App\Domain\User\UserDuplicateCreateException;
use App\Domain\User\UserNotCreateException;
use PDO;

class CommandUserRepository implements UserCommandRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function create(User $user): int
    {
        try {
            $statement = $this->db->prepare('
            INSERT INTO
                public.users  (first_name, last_name, username)
            VALUES
                (:firstname, :lastname, :username)
            RETURNING id;
        
        ');
            $statement->execute([
                'firstname' => $user->getFirstName(),
                'lastname'  => $user->getLastName(),
                'username'  => $user->getUsername()
            ]);
            $result = $statement->fetch();
            return $result['id'];
        } catch (\PDOException $exception) {
            if ($exception->errorInfo[0] == 23505) {
                throw new UserDuplicateCreateException();
            }
            throw new UserNotCreateException();
        }

    }
}