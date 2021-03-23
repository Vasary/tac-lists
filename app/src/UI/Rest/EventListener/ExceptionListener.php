<?php

declare(strict_types=1);

namespace App\UI\Rest\EventListener;

use App\Domain\SystemCodes;
use App\UI\Rest\Exception\BadRequestException;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use DomainException;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Throwable;

final class ExceptionListener
{
    public function __construct(private LoggerInterface $logger) {}

    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        $data['message'] = $exception->getMessage();
        $data['code'] = $exception->getCode();

        if ($exception instanceof BadRequestException) {
            /* @var BadRequestException $exception **/
            $data['message'] = $exception->errors();
        }

        if (0 === $exception->getCode() && !($exception instanceof DomainException)) {
            $data['code'] = SystemCodes::SYSTEM_MALFORMED;

            $this->logger->error('Exception trace', $event->getThrowable()->getTrace());
        }

        if ($exception->getPrevious() instanceof UniqueConstraintViolationException) {
            $data['message'] = 'Duplication error';
            $data['code'] = SystemCodes::ALREADY_EXISTS;
        }

        $event->allowCustomResponseCode();
        $event->setResponse(new JsonResponse($data, $this->resolveStatusCode($data['code'])));
    }

    private function resolveStatusCode(int $code): int
    {
        return
            match ($code) {
                SystemCodes::SHOPPING_LIST_CREATION_ERROR => Response::HTTP_INTERNAL_SERVER_ERROR,
                SystemCodes::PERMISSION_DENIED => Response::HTTP_FORBIDDEN,
                SystemCodes::UNIT_NOT_FOUND => Response::HTTP_NOT_FOUND,
                SystemCodes::LABEL_NOT_FOUND => Response::HTTP_NOT_FOUND,
                SystemCodes::IMAGE_NOT_FOUND => Response::HTTP_NOT_FOUND,
                SystemCodes::CATEGORY_NOT_FOUND => Response::HTTP_NOT_FOUND,
                SystemCodes::PERSON_NOT_FOUND => Response::HTTP_NOT_FOUND,
                SystemCodes::TEMPLATE_NOT_FOUND => Response::HTTP_NOT_FOUND,
                SystemCodes::LIST_NOT_FOUND => Response::HTTP_NOT_FOUND,
                SystemCodes::ALREADY_EXISTS => Response::HTTP_CONFLICT,
                SystemCodes::ITEM_NOT_FOUND => Response::HTTP_NOT_FOUND,
                SystemCodes::POINT_NOT_FOUND => Response::HTTP_NOT_FOUND,
                default => Response::HTTP_INTERNAL_SERVER_ERROR
            };
    }
}
