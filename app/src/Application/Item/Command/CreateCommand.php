<?php

declare(strict_types=1);

namespace App\Application\Item\Command;

use Symfony\Component\Uid\UuidV4;

final class CreateCommand
{
    public function __construct(
        private UuidV4 $template,
        private UuidV4 $list,
        private UuidV4 $unit,
        private int $value,
        private array $points,
        private array $images,
        private UuidV4 $initiator
    ) {}

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

    public function initiator(): UuidV4
    {
        return $this->initiator;
    }
}