<?php
use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    public function run(): void
    {
        $this->execute(<<<SQL
            INSERT INTO
                public.users  (first_name, last_name, username)
            VALUES
                ('Andrzej', 'Kowalski', 'kowal69'),
                ('Kamil', 'Karkonosz', 'Kark');
        SQL);
    }


}
