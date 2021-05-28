<?php declare(strict_types=1);

namespace App\Domain\Order;

use Domain\Common\DataTransferToExternalSystem\PaymentSystem\Constant\PaymentSystemOrderAddToBufferQueueConst;
use Exception;

class OrderRepository
{
    private \PDO $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function exampleInsert($data)
    {
        $sql = <<<SQL
            INSERT INTO example_table (
                col_1,
                col_2,
                col_3,
                col_4
            ) VALUES (
                :data1,
                :data2,
                :data3,
                :data4
            ) RETURNING id;
            
SQL;
        $params = [
            'data1' => $data['data1'],
            'data2' => $data['data2'],
            'data3' => $data['data3'],
            'data4' => $data['data4'],
        ];
        $query = $this->db->prepare($sql);
        $query->setFetchMode(\PDO::FETCH_COLUMN, 0);
        $query->execute($data);

        return $query->fetch();
    }

    public function exampleGet($data)
    {
        $sql = <<<SQL
            SELECT * FROM example_table WHERE id = :id;
            
SQL;
        $params = [
            'data1' => $data['data1'],
            'data2' => $data['data2'],
            'data3' => $data['data3'],
            'data4' => $data['data4'],
        ];
        $query = $this->db->prepare($sql);
        $query->setFetchMode(\PDO::FETCH_COLUMN, 0);
        $query->execute($data);

        return $query->fetch();

    }

}
