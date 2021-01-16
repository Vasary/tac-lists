<?php

declare(strict_types=1);

namespace App\Application\Category\Handler\Query;

use App\Application\Category\Provider\CategoryProvider;
use App\Application\Category\Query\GetCategories;
use App\Application\Category\Response\GetCategoriesResponse;
use App\Application\Category\Response\GetCategoryResponse;
use App\Domain\Entity\Category;
use App\Domain\Handler\AbstractQueryHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use function Symfony\Component\String\u;

final class GetCategoriesQueryHandler extends AbstractQueryHandler implements MessageHandlerInterface
{
    private CategoryProvider $provider;

    public function __construct(CategoryProvider $provider)
    {
        $this->provider = $provider;
    }

    public function __invoke(GetCategories $query): GetCategoriesResponse
    {
        $categories = array_map(
            fn(Category $category) => new GetCategoryResponse(
                u($category->id()),
                u($category->name()),
                u($category->marker()),
                u($category->region()),
                $category->updated(),
                $category->created()
            ),
            $this->provider->all(),
        );

        return new GetCategoriesResponse($categories);
    }
}
