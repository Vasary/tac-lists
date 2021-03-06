<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Item\Argument;

use Symfony\Component\Uid\UuidV4;

final class Create
{
    public function __construct(
        private UuidV4 $template,
        private UuidV4 $list,
        private UuidV4 $unit,
        private int $value,
        private array $points,
        private array $images
    ) {
    }

    public function template(): UuidV4
    {
        return $this->template;
    }

    public function list(): UuidV4
    {
        return $this->list;
    }

    public function unit(): UuidV4
    {
        return $this->unit;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function points(): array
    {
        return $this->points;
    }

    public function images(): array
    {
        return $this->images;
    }
}
