<?php

declare(strict_types=1);

namespace App\Application\Image\Provider;

use App\Domain\Exception\ImageNotFoundException;
use App\Domain\Item\Model\ItemImage;
use App\Domain\Item\Repository\ItemImageRepositoryInterface;
use App\Domain\Template\Model\TemplateImage;
use App\Domain\Template\Repository\TemplateImageRepositoryInterface;
use Symfony\Component\Uid\UuidV4;

final class DataProvider
{
    public function __construct(
        private TemplateImageRepositoryInterface $templateImageRepository,
        private ItemImageRepositoryInterface $itemImageRepository
    ) {
    }

    public function get(UuidV4 $id): ItemImage | TemplateImage
    {
        if (null !== $templateImage = $this->templateImageRepository->get($id)) {
            return $templateImage;
        }

        if (null !== $itemImage = $this->itemImageRepository->get($id)) {
            return $itemImage;
        }

        throw new ImageNotFoundException($id);
    }
}
