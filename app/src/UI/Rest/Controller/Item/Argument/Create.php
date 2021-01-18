<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Item\Argument;

use Symfony\Component\Uid\UuidV4;

final class Create
{
    public function __construct(
        private UuidV4 $template,
        private UuidV4 $category,
        private UuidV4 $unit,
        private int $value,
        private array $places,
        private array $images
    ) {}

    public function template(): UuidV4
    {
        return $this->template;
    }

    public function category(): UuidV4
    {
        return $this->category;
    }

    public function unit(): UuidV4
    {
        return $this->unit;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function places(): array
    {
        return $this->places;
    }

    public function images(): array
    {
        return $this->images;
    }
}
