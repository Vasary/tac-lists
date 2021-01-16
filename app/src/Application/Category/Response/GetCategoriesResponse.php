<?php

declare(strict_types=1);

namespace App\Application\Category\Response;

use App\Domain\Response\AbstractResponse;

final class GetCategoriesResponse extends AbstractResponse
{
    public array $categories;

    public function __construct(array $categories)
    {
        $this->categories = $categories;
    }
}