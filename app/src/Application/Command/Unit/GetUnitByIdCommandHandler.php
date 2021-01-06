<?php

declare(strict_types=1);

namespace App\Application\Command\Unit;

use App\Application\Command\AbstractCommandHandler;
use App\Application\Response\Unit\GetUnitByIdResponse;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class GetUnitByIdCommandHandler extends AbstractCommandHandler implements MessageHandlerInterface
{
    private UnitProvider $provider;

    public function __construct(UnitProvider $provider)
    {
        $this->provider = $provider;
    }

    public function __invoke(GetUnitByIdCommand $command): GetUnitByIdResponse
    {



        return
            new GetUnitByIdResponse(
                $unit->name(),
                $unit->shortName(),
                $unit->region(),
                $unit->values()
            )
        ;
    }
}
