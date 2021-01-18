<?php

declare(strict_types=1);

namespace App\Application\Item\Command;

use Symfony\Component\Uid\UuidV4;

final class CreateCommand
{
    public function __construct(
        private UuidV4 $template,
        private UuidV4 $cagegory,
        private UuidV4 $unit,
        private int $value,
        private array $places,
        private array $images,
        private UuidV4 $initiator
    ) {}

    public function template(): UuidV4
    {
        return $this->template;
    }

    public function category(): UuidV4
    {
        return $this->cagegory;
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

    public function initiator(): UuidV4
    {
        return $this->initiator;
    }
}