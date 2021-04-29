<?php
use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    public function run(): void
    {
        $this->execute(<<<SQL
            INSERT INTO
                public.users  (first_name, last_name, email)
            VALUES
                ('TestName', 'TestLastName', 'test@test.com'),
                ('PoProstuImie', 'PoProstuNazwisko', 'nazwisko@test.com');
        SQL);
    }


}
