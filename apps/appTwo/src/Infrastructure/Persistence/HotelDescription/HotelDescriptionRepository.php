<?php declare(strict_types=1);

namespace App\Infrastructure\Persistence\HotelDescription;

use App\Domain\HotelDescription\HotelDescription;
use App\Domain\User\User;
use App\Domain\HotelDescription\HotelDescriptionRepository as DomainHotelDescriptionQueryRepository;
use PDO;

class HotelDescriptionRepository implements DomainHotelDescriptionQueryRepository
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
                identifier,
                name,
                description
            FROM
                hotel_description
        SQL);
        $statement->execute();

        foreach ($statement->fetchAll() as $row) {
            $collection[] = new HotelDescription(
                $row['identifier'],
                $row['name'],
                $row['description']
            );
        }

        return $collection;
    }

    public function find(string $identifier): ?HotelDescription
    {
        $statement = $this->db->prepare(<<<SQL
            SELECT
                identifier,
                name,
                description
            FROM
                hotel_description
            WHERE
                identifier = :identifier
        SQL);
        $statement->execute(['identifier' => $identifier]);
        $row = $statement->fetch(\PDO::FETCH_ASSOC);

        return $row ? new HotelDescription($row['identifier'], $row['name'], $row['description']) : null;
    }

    public function delete(string $identifier): void
    {
        $statement = $this->db->prepare(<<<SQL
            DELETE FROM
                hotel_description
            WHERE
                identifier = :identifier
        SQL);
        $statement->execute(['identifier' => $identifier]);
    }

    public function create(string $identifier, string $name, string $description): void
    {
        $statement = $this->db->prepare(<<<SQL
            INSERT INTO 
                hotel_description (identifier, name, description)
            VALUES
                (:identifier, :name, :description)
        SQL);
        $statement->execute([
            'identifier' => $identifier,
            'name' => $name,
            'description' => $description,
        ]);
    }

    public function update(string $identifier, string $name, string $description): void
    {
        $statement = $this->db->prepare(<<<SQL
            UPDATE
                hotel_description
            SET
                name = :name, description = :description, updated_at = NOW()
            WHERE
                identifier = :identifier
        SQL);
        $statement->execute([
            'identifier' => $identifier,
            'name' => $name,
            'description' => $description,
        ]);
    }
}
