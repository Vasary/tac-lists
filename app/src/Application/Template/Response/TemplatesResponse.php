<?php

declare(strict_types=1);

namespace App\Application\Template\Response;

final class TemplatesResponse
{
    public function __construct(public array $templates)
    {
    }
}
