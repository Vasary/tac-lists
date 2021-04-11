<?php

declare(strict_types=1);

namespace App\Application\Category\Handler\Query;

use App\Application\Category\Provider\CategoryProvider;
use App\Application\Category\Query\GetCategory;
use App\Application\Category\Response\GetCategoryResponse;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class GetCategoryByIdQueryHandler implements MessageHandlerInterface
{
    private CategoryProvider $provider;

    public function __construct(CategoryProvider $provider)
    {
        $this->provider = $provider;
    }

    public function __invoke(GetCategory $query): GetCategoryResponse
    {
        $category = $this->provider->get($query->getId());

        return
            new GetCategoryResponse(
                $category->id(),
                $category->name(),
                $category->marker(),
                $category->region(),
                $category->updated(),
                $category->created()
            );
    }
}
