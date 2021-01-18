<?php

declare(strict_types=1);

namespace App\Application\Template\Response;

use App\Domain\Response\AbstractResponse;

final class AllTemplatesResponse extends AbstractResponse
{
    public array $templates;

    public function __construct(array $templates)
    {
        $this->templates = $templates;
    }
}
