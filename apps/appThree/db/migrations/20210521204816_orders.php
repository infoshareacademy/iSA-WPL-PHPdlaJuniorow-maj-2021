<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Orders extends AbstractMigration
{
    public function change(): void
    {
        $this->execute(<<<SQL
            CREATE TABLE "order"
            (
                id SERIAL PRIMARY KEY,
                hotel_name VARCHAR(64) not null,
                starts_at DATE NOT NULL,
                ends_at DATE NOT NULL,
                country VARCHAR(64) NOT NULL,
                purchaser VARCHAR(128) NOT NULL,
                price NUMERIC(8,2) NOT NULL
            );

            INSERT INTO
                public.order (id, hotel_name, starts_at, ends_at, country, purchaser, price)
            VALUES
                (1000, 'HOT18932', '2021-11-06', '2021-11-13', 'Grecja', 'Jan Kowalski', 6338.60),
                (1001, 'HOT5435', '2021-05-27', '2021-06-03', 'Egipt', 'Adam Nowak', 4823.22),
                (1002, 'HOT29839', '2021-09-01', '2021-09-08', 'Turcja', 'Paweł Kowalczyk', 5787.00)
            ;

            ALTER SEQUENCE order_id_seq RESTART WITH 1003 INCREMENT BY 1;
        SQL);
    }
}
