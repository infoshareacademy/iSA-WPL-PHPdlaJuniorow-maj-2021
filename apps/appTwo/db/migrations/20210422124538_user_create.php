<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class UserCreate extends AbstractMigration
{
    public function up(): void
    {
        $this->execute(<<<SQL
            create table users
            (
                id serial not null
                    constraint users_pk
                        primary key,
                first_name VARCHAR(50) not null,
                last_name VARCHAR(50) not null,
                username varchar(255)
            );

            create unique index users_username_uindex
                on users (username);
        SQL);
    }

    public function down(): void
    {
        $this->execute(<<<SQL
            DROP table users;
        SQL);
    }
}
