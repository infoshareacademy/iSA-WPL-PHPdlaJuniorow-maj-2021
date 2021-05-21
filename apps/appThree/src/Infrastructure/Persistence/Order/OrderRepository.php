<?php declare(strict_types=1);

namespace App\Infrastructure\Persistence\Order;

use App\Domain\Order\Order;
use App\Domain\Order\OrderRepository as DomainOrderRepository;
use PDO;
use DateTime;

class OrderRepository implements DomainOrderRepository
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function findAll(): array
    {
        $collection = [];
        $statement = $this->db->prepare(<<<SQL
            SELECT
                id,
                hotel_name,
                starts_at,
                ends_at,
                country,
                purchaser,
                price
            FROM
                "order" 
        SQL);
        $statement->execute();

        foreach ($statement->fetchAll() as $row) {
            $collection[] = new Order(
                $row['id'],
                $row['hotel_name'],
                new DateTime($row['starts_at']),
                new DateTime($row['ends_at']),
                $row['country'],
                $row['purchaser'],
                (float) $row['price']
            );
        }

        return $collection;
    }

    public function find(int $id): ?Order
    {
        $statement = $this->db->prepare(<<<SQL
            SELECT
                id,
                hotel_name,
                starts_at,
                ends_at,
                country,
                purchaser,
                price
            FROM
                "order"
            WHERE
                id = :id
        SQL);
        $statement->execute(['id' => $id]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Order(
            $row['id'],
            $row['hotel_name'],
            new DateTime($row['starts_at']),
            new DateTime($row['ends_at']),
            $row['country'],
            $row['purchaser'],
            (float) $row['price']
        );
    }
}
