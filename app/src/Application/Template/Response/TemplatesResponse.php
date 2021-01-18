<?php

declare(strict_types=1);

namespace App\Application\Template\Response;

use App\Domain\Response\AbstractResponse;

final class TemplatesResponse extends AbstractResponse
{
    public function __construct(public array $templates) {}
}
