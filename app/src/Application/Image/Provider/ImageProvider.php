<?php

declare(strict_types=1);

namespace App\Application\Image\Provider;

use App\Domain\Entity\ItemImage;
use App\Domain\Exception\ImageNotFoundException;
use App\Domain\Repository\ImageRepositoryInterface;

final class ImageProvider
{
    private ImageRepositoryInterface $repository;

    public function __construct(ImageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function get(string $id): ItemImage
    {
        if (null === $image = $this->repository->get($id)) {
            throw new ImageNotFoundException($id);
        }

        return $image;
    }
}
