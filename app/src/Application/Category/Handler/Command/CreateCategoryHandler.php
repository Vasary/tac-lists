<?php

declare(strict_types=1);

namespace App\Application\Category\Handler\Command;

use App\Application\Category\Command\CreateCategoryCommand;
use App\Application\Category\Creator\CategoryCreator;
use App\Application\Category\Response\CreateCategoryResponse;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use function Symfony\Component\String\u;

final class CreateCategoryHandler implements MessageHandlerInterface
{
    private CategoryCreator $creator;

    public function __construct(CategoryCreator $creator)
    {
        $this->creator = $creator;
    }

    public function __invoke(CreateCategoryCommand $command): CreateCategoryResponse
    {
        $region = u('RU');

        $category = $this->creator->create($command->name(), $command->color(), $region);

        return
            new CreateCategoryResponse(
                $category->id(),
                $category->name(),
                $category->marker(),
                $category->region(),
                $category->created(),
                $category->updated()
            )
        ;
    }
}
