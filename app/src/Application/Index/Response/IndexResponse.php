<?php

declare(strict_types=1);

namespace App\Application\Index\Response;

final class IndexResponse
{
    public function __construct(
        public string $name,
        public string $version,
        public string $license,
        public string $description,
        public array $authors
    ) {
    }
}
