<?php

declare(strict_types=1);

namespace App\Application\Category\Command;

use App\Domain\Command\AbstractCommand;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class CreateCategoryCommand extends AbstractCommand
{
    public function __construct(
        private UnicodeString $name,
        private UnicodeString $color,
        private UuidV4 $initializer
    ) {}

    public function name(): UnicodeString
    {
        return $this->name;
    }

    public function color(): UnicodeString
    {
        return $this->color;
    }

    public function initializer(): UuidV4
    {
        return $this->initializer;
    }
}
