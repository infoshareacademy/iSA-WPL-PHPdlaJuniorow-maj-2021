<?php declare(strict_types=1);

namespace App\Application\Actions\PingExternalApp\AppTwo;

use App\Application\Actions\Action;
use App\Infrastructure\Persistence\AppTwo\AppTwoQueryRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

class AppTwoPingAction extends Action
{
    protected AppTwoQueryRepository $appTwoQueryRepository;

    public function __construct(LoggerInterface $logger,
                                AppTwoQueryRepository $appTwoQueryRepository
    ) {
        parent::__construct($logger);
        $this->appTwoQueryRepository = $appTwoQueryRepository;
    }

    public function action(): Response
    {
      $this->logger->info("Strzelono pingiem do aplikacji appTwo");
       return $this->respondWithData($this->appTwoQueryRepository->ping()->jsonSerialize());
    }
}