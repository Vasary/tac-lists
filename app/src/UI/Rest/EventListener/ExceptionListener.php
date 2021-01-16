<?php

declare(strict_types=1);

namespace App\UI\Rest\EventListener;

use App\UI\Rest\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Throwable;

final class ExceptionListener
{
    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        $data['message'] = $exception->getMessage();
        $data['code'] = $exception->getCode();

        if ($exception instanceof BadRequestException) {
            /** @var BadRequestException $exception **/
            $data['message'] = $exception->errors();
        }

        $event->setResponse(new JsonResponse($data, $this->resolveStatusCode($exception)));
    }

    private function resolveStatusCode(Throwable $exception): int
    {
        return
            match ($exception->getCode()) {
                default => Response::HTTP_INTERNAL_SERVER_ERROR
            }
        ;
    }
}