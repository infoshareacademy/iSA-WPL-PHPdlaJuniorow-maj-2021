<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class DbCreate extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function up(): void
    {
        $this->execute(<<<SQL
create table orders
(
	id serial not null
		constraint orders_pk
			primary key,
	client varchar(100) not null,
	status varchar(30) not null,
	price_amount integer default 0 not null,
	currency varchar default 'PLN'::character varying not null
);

alter table orders owner to root;

create index orders_status_index
	on orders (status);


SQL);
    }
}
