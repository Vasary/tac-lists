<?php

declare(strict_types=1);

namespace App\Application\Unit\Handler;

use App\Application\Unit\Command\GetUnitsCommand;
use App\Application\Unit\Provider\UnitProvider;
use App\Application\Unit\Response\GetUnitByIdResponse;
use App\Application\Unit\Response\GetUnitsResponse;
use App\Domain\Entity\Unit;
use App\Domain\Handler\AbstractCommandHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class GetUnitsCommandHandler extends AbstractCommandHandler implements MessageHandlerInterface
{
    private UnitProvider $provider;

    public function __construct(UnitProvider $provider)
    {
        $this->provider = $provider;
    }

    public function __invoke(GetUnitsCommand $command): GetUnitsResponse
    {
        $units = array_map(
            fn (Unit $unit) => new GetUnitByIdResponse(
                $unit->name(),
                $unit->shortName(),
                $unit->region(),
                $unit->values()
            ),
            $this->provider->getAll(),
        );

        return new GetUnitsResponse($units);
    }
}
