<?php

declare(strict_types=1);

namespace App\Application\List\Handler\Query;

use App\Application\List\Provider\Provider;
use App\Application\List\Query\GetListQuery;
use App\Application\List\Response\ListResponse;
use App\Domain\Entity\Item;
use App\Domain\Entity\Person;
use App\Domain\Exception\PermissionDeniedException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class GetListQueryHandler implements MessageHandlerInterface
{
    public function __construct(private Provider $provider)
    {
    }

    public function __invoke(GetListQuery $query): ListResponse
    {
        $list = $this->provider->get($query->list());

        $personIsMember =
            $list
                ->members()
                ->exists(
                    fn (int $_, Person $person) => $person->id()->toBinary() === $query->person()->toBinary()
                )
        ;

        if (!$personIsMember) {
            throw new PermissionDeniedException($query->person(), $list->id());
        }

        return
            new ListResponse(
                $list->id(),
                $list->name(),
                array_map(fn (Item $item) => $item->id(), $list->items()->toArray()),
                array_map(fn (Person $person) => $person->id(), $list->members()->toArray()),
                $list->created(),
                $list->updated()
            )
        ;
    }
}
