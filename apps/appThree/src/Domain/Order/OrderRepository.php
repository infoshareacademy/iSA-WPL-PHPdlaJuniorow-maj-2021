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

    public function createOrder(OrderCreateCommand $order)
    {
        $sql = <<<SQL
            INSERT INTO orders (
                client,
                status,
                price_amount,
                currency
            ) VALUES (
                :client,
                :status,
                :price,
                :currency
            ) RETURNING id;
            
SQL;
        $params = [
            'client' => $order->getClient(),
            'status' => $order->getStatus(),
            'price' => $order->getPriceAmount(),
            'currency' => $order->getCurrency()
        ];
        $query = $this->db->prepare($sql);
        $query->setFetchMode(\PDO::FETCH_COLUMN, 0);
        $query->execute($params);

        return $query->fetch();
    }

    public function getOrder(int $orderId)
    {
        $sql = <<<SQL
            SELECT * FROM orders WHERE id = :id;     
SQL;
        $params = [
            'id' => $orderId,
        ];
        $query = $this->db->prepare($sql);
        $query->execute($params);

        return $query->fetch();
    }

}
