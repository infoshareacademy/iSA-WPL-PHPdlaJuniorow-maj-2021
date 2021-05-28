<?php declare(strict_types=1);

namespace App\Domain\Logger;

class LoggerService
{
    /**
     * @var LoggerRepository
     */
    private $loggerRepository;

    public function __construct(LoggerRepository $loggerRepository)
    {
        $this->loggerRepository = $loggerRepository;
    }

    public function create(LogCreateCommand $logCreateCommand)
    {
        try {
            return $this->loggerRepository->createLog($logCreateCommand);
        } catch (\Exception $exc) {
        }
    }

}
