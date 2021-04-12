<?php

declare(strict_types=1);

namespace App\Application\Category\Response;

final class GetCategoriesResponse
{
    public function __construct(public array $categories)
    {
    }
}
