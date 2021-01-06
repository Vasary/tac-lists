<?php

declare(strict_types=1);

namespace App\Application\Index\Response;

use App\Domain\Response\AbstractResponse;

final class IndexResponse extends AbstractResponse
{
    public string $name;

    public string $version;

    public string $license;

    public string $description;

    public array $authors;

    public function __construct(string $name, string $version, string $license, string $description, array $authors)
    {
        $this->name = $name;
        $this->version = $version;
        $this->license = $license;
        $this->description = $description;
        $this->authors = $authors;
    }
}
