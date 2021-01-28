<?php

declare(strict_types=1);

namespace App\Application\Unit\Handler;

use App\Application\Unit\Provider\UnitProvider;
use App\Application\Unit\Query\UnitQuery;
use App\Application\Unit\Response\UnitResponse;
use App\Domain\Handler\AbstractQueryHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use function Symfony\Component\String\u;

final class UnitQueryHandler extends AbstractQueryHandler implements MessageHandlerInterface
{
    public function __construct(private UnitProvider $provider)
    {
    }

    public function __invoke(UnitQuery $query): UnitResponse
    {
        $unit = $this->provider->get($query->id());

        return
            new UnitResponse(
                $unit->id(),
                u($unit->name()),
                u($unit->shortName()),
                $unit->region(),
                $unit->values()
            )
        ;
    }
}
