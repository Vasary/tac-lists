<?php

declare(strict_types=1);

namespace App\Application\Contract;

interface TransactionServiceInterface
{
    /**
     * @throws \Throwable
     */
    public function __invoke(\Closure $closure): mixed;
}
