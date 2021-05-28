<?php declare(strict_types=1);

namespace App\Domain\Logger;

use Domain\Common\DataTransferToExternalSystem\PaymentSystem\Constant\PaymentSystemOrderAddToBufferQueueConst;
use Exception;

class LoggerRepository
{
    private \PDO $db;

    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    public function createLog(LogCreateCommand $log)
    {
        $sql = <<<SQL
            INSERT INTO log (
                body,
                message
            ) VALUES (
                :body,
                :message
            );
            
SQL;
        $params = [
            'body' => $log->getBody(),
            'message' => $log->getMessage(),
        ];
        $query = $this->db->prepare($sql);
        $query->setFetchMode(\PDO::FETCH_COLUMN, 0);
        $query->execute($params);

        return $query->fetch();
    }

}
