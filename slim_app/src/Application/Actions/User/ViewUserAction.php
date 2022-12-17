<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use Psr\Http\Message\ResponseInterface as Response;
use Sentry\SentrySdk;
use Sentry\State\Hub;
use Sentry\State\Scope;


class ViewUserAction extends UserAction
{
    /**
     * {@inheritdoc}
     */
    protected function action(): Response
    {
        $userId = (int) $this->resolveArg('id');
        $user = $this->userRepository->findUserOfId($userId);

        $this->logger->info("User of id `${userId}` was viewed.");

        try {
            throw new \DomainException('なんかのドメイン〜！');
        } catch (\Throwable $exception) {
            \Sentry\captureException($exception);
        }


        return $this->respondWithData($user);
    }
}
