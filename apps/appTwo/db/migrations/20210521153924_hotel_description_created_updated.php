<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class HotelDescriptionCreatedUpdated extends AbstractMigration
{
    public function change(): void
    {
        $this->execute(<<<SQL
            ALTER TABLE hotel_description ADD COLUMN created_at TIMESTAMP(0) NOT NULL DEFAULT NOW();
            ALTER TABLE hotel_description ADD COLUMN updated_at TIMESTAMP(0) NOT NULL DEFAULT NOW()
        SQL);
    }
}
