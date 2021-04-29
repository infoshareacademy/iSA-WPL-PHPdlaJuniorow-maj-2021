<?php declare(strict_types=1);

namespace App\Application\Actions\PingExternalApp\AppOne;

use App\Application\Actions\Action;
use App\Infrastructure\Persistence\AppOne\AppOneQueryRepository;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use Throwable;

class AppOnePingAction extends Action
{
    protected AppOneQueryRepository $appOneQueryRepository;

    public function __construct(LoggerInterface $logger,
                                AppOneQueryRepository $appOneQueryRepository
    ) {
        parent::__construct($logger);
        $this->appOneQueryRepository = $appOneQueryRepository;
    }

    public function action(): ResponseInterface
    {
        try {
            $this->logger->info("Strzelono pingiem do aplikacji AppOne");
            return $this->respondWithData($this->appOneQueryRepository->ping()->jsonSerialize());
        }catch (Throwable $exception) {
            return $this->respondWithData(
                [$exception->getMessage()],
                StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR
            );
        }
    }
}