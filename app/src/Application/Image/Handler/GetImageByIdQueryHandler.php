<?php

declare(strict_types=1);

namespace App\Application\Image\Handler;

use App\Application\Image\Provider\ImageProvider;
use App\Application\Image\Query\GetImageByIdQuery;
use App\Application\Image\Response\GetImageResponse;
use App\Domain\Handler\AbstractQueryHandler;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;
use function Symfony\Component\String\u;

final class GetImageByIdQueryHandler extends AbstractQueryHandler implements MessageHandlerInterface
{
    private ImageProvider $provider;

    public function __construct(ImageProvider $provider)
    {
        $this->provider = $provider;
    }

    public function __invoke(GetImageByIdQuery $query): GetImageResponse
    {
        $image = $this->provider->get($query->getId()->toString());

        return
            new GetImageResponse(
                u($image->id()),
                u($image->link()),
                $image->created(),
                $image->updated()
            )
        ;
    }
}
