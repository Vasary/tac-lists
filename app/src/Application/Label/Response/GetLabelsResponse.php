<?php

declare(strict_types=1);

namespace App\Application\Label\Response;

use App\Domain\Response\AbstractResponse;

final class GetLabelsResponse extends AbstractResponse
{
    public array $labels;

    public function __construct(array $labels)
    {
        $this->labels = $labels;
    }
}
