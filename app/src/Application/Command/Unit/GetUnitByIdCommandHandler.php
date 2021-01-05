<?php

declare(strict_types=1);

namespace App\Application\Command\Unit;

use App\Application\Command\AbstractCommandHandler;
use App\Application\Request\Unit\GetUnitByIdRequest;
use App\Application\Response\Unit\GetUnitByIdResponse;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class GetUnitByIdCommandHandler extends AbstractCommandHandler implements MessageHandlerInterface
{
    private SerializerInterface $serializer;

    private UnitProvider $provider;

    public function __construct(SerializerInterface $serializer, UnitProvider $provider)
    {
        $this->serializer = $serializer;
        $this->provider = $provider;
    }

    public function __invoke(GetUnitByIdCommand $command): GetUnitByIdResponse
    {
        /** @var GetUnitByIdRequest $request */
        $request = $this->serializer->deserialize($command->request, GetUnitByIdRequest::class, 'array');

        var_dump($request);

        exit;
        $unit = $this->provider->get($request->id);

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
