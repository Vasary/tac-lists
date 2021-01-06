<?php

declare(strict_types=1);

namespace App\Application\Unit\Handler;

use App\Application\Unit\Command\GetUnitByIdCommand;
use App\Application\Unit\Provider\UnitProvider;
use App\Application\Unit\Response\GetUnitByIdResponse;
use App\Domain\Handler\AbstractCommandHandler;
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
