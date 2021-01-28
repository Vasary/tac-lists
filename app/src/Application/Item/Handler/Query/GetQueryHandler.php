<?php

declare(strict_types=1);

namespace App\Application\Item\Handler\Query;

use App\Application\Item\Handler\BaseHandler;
use App\Application\Item\Provider\DataProvider;
use App\Application\Item\Query\GetItemQuery;
use App\Application\Item\Response\ItemResponse;
use App\Infrastructure\Trait\ObjectAccess;

final class GetQueryHandler extends BaseHandler
{
    use ObjectAccess;

    public function __construct(private DataProvider $provider)
    {
    }

    public function __invoke(GetItemQuery $query): ItemResponse
    {
        $item = $this->provider->get($query->item());

        $this->hasPermission($item->list()->members(), $query->initiator(), $item->id());

        return $this->createResponse($item);
    }
}
