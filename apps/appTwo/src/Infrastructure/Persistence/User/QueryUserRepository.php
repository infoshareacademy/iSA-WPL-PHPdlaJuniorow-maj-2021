<?php


namespace App\Infrastructure\Persistence\User;

use App\Domain\User\User;
use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserRepository;
use PDO;

class QueryUserRepository implements UserRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function findAll(): array
    {
        $statement = $this->db->prepare('
            SELECT
              *
            FROM
              users
        ');
        $statement->execute();
        $results = $statement->fetchAll();

        if (empty($results)) {
            return [];
        }
        $users = [];
        foreach ($results as $user) {
            $users[$user['id']] = new User(
                $user['id'],
                $user['username'],
                $user['first_name'],
                $user['last_name'],
            );
        }

        return $users;
    }

    public function findUserOfId(int $id): User
    {
        $statement = $this->db->prepare('
            SELECT
              *
            FROM
              users
            WHERE id = :id
        ');
        $statement->execute([
            'id' => $id
        ]);
        $result = $statement->fetch();

        if (empty($result)) {
            throw new UserNotFoundException();
        }

        return new User(
            $result['id'],
            $result['username'],
            $result['first_name'],
            $result['last_name']
        );
    }
}