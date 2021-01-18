<?php

declare(strict_types=1);

namespace App\Application\Index\Response;

use App\Domain\Response\AbstractResponse;

final class IndexResponse extends AbstractResponse
{
    public function __construct(
        public string $name,
        public string $version,
        public string $license,
        public string $description,
        public array $authors
    ) {}
}
