<?php

declare(strict_types=1);

namespace App\Application\Image\Handler;

use App\Application\Image\Provider\DataProvider;
use App\Application\Image\Query\GetImageQuery;
use App\Application\Image\Response\ImageResponse;
use App\Domain\Entity\ItemImage;
use App\Domain\Query\AbstractQuery;
use App\Infrastructure\Trait\ObjectAccess;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class GetImageQueryHandler extends AbstractQuery implements MessageHandlerInterface
{
    use ObjectAccess;

    public function __construct(private DataProvider $provider)
    {
    }

    public function __invoke(GetImageQuery $query): ImageResponse
    {
        $image = $this->provider->get($query->id());

        if ($image instanceof ItemImage) {
            $this->hasPermission($image->item()->list()->members(), $query->initiator(), $image->id());
        }

        return new ImageResponse($image->id(), $image->link());
    }
}
