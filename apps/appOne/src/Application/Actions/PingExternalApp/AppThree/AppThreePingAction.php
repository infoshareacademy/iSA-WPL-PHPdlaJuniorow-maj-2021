<?php declare(strict_types=1);

namespace App\Application\Actions\PingExternalApp\AppThree;

use App\Application\Actions\Action;
use App\Infrastructure\Persistence\AppThree\AppThreeQueryRepository;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Throwable;

class AppThreePingAction extends Action
{
    protected AppThreeQueryRepository $appThreeQueryRepository;

    public function __construct(LoggerInterface $logger,
                                AppThreeQueryRepository $appThreeQueryRepository
    ) {
        parent::__construct($logger);
        $this->appThreeQueryRepository = $appThreeQueryRepository;
    }

    public function action(): ResponseInterface
    {
        try {
            $this->logger->info("Strzelono pingiem do aplikacji AppThree");
            return $this->respondWithData($this->appThreeQueryRepository->ping()->jsonSerialize());
        }catch (Throwable $exception) {
            return $this->respondWithData(
                [$exception->getMessage()],
                StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR
            );
        }
    }
}