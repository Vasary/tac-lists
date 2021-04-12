<?php

declare(strict_types=1);

namespace App\Application\Person\Handler\Query;

use App\Application\Person\Provider\DataProvider;
use App\Application\Person\Query\GetQuery;
use App\Application\Person\Response\PersonResponse;
use App\Domain\ShoppingList\Model\ShoppingList;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class GetQueryHandler implements MessageHandlerInterface
{
    public function __construct(private DataProvider $provider)
    {
    }

    public function __invoke(GetQuery $query): PersonResponse
    {
        $person = $this->provider->get($query->person());

        return
            new PersonResponse(
                $person->id(),
                $person->region(),
                array_map(fn (ShoppingList $list) => $list->id(), $person->lists()->toArray())
            )
        ;
    }
}
