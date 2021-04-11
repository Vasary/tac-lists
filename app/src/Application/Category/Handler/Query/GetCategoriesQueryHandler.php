<?php

declare(strict_types=1);

namespace App\Application\Category\Handler\Query;

use App\Application\Category\Provider\CategoryProvider;
use App\Application\Category\Query\GetCategories;
use App\Application\Category\Response\GetCategoriesResponse;
use App\Application\Category\Response\GetCategoryResponse;
use App\Domain\Entity\Category;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class GetCategoriesQueryHandler implements MessageHandlerInterface
{
    private CategoryProvider $provider;

    public function __construct(CategoryProvider $provider)
    {
        $this->provider = $provider;
    }

    public function __invoke(GetCategories $query): GetCategoriesResponse
    {
        $categories = array_map(
            fn (Category $category) => new GetCategoryResponse(
                $category->id(),
                $category->name(),
                $category->marker(),
                $category->region(),
                $category->updated(),
                $category->created()
            ),
            iterator_to_array($this->provider->regional($query->initiator())),
        );

        return new GetCategoriesResponse($categories);
    }
}
