<?php

declare(strict_types=1);

namespace App\Application\Category\Response;

use App\Domain\Response\AbstractResponse;

final class GetCategoriesResponse extends AbstractResponse
{
    public function __construct(public array $categories) {}
}