<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Contract\TransactionServiceInterface;
use Doctrine\ORM\EntityManagerInterface;

final class TransactionService implements TransactionServiceInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(\Closure $closure): mixed
    {
        $this->entityManager->getConnection()->beginTransaction();

        try {
            $result = $closure();

            $this->entityManager->flush();
            $this->entityManager->getConnection()->commit();

            return $result;
        } catch (\Throwable $exception) {
            $this->entityManager->close();
            $this->entityManager->getConnection()->rollBack();

            throw $exception;
        }
    }
}
