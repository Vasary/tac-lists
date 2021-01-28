<?php

declare(strict_types=1);

namespace App\Application\Point\Handler;

use App\Application\Point\Provider\DataProvider;
use App\Application\Point\Query\GetPointQuery;
use App\Application\Point\Response\PointResponse;
use App\Domain\Query\AbstractQuery;
use App\Infrastructure\Trait\ObjectAccess;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class GetPointQueryHandler extends AbstractQuery implements MessageHandlerInterface
{
    use ObjectAccess;

    public function __construct(private DataProvider $provider)
    {
    }

    public function __invoke(GetPointQuery $query): PointResponse
    {
        $point = $this->provider->get($query->id());

        $this->hasPermission($point->item()->list()->members(), $query->initiator(), $point->id());

        return new PointResponse($point->id(), $point->latitude(), $point->longitude(), $point->comment());
    }
}
