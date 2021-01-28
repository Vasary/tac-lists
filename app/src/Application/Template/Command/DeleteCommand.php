<?php

declare(strict_types=1);

namespace App\Application\Template\Command;

use App\Domain\Command\AbstractCommand;
use JetBrains\PhpStorm\Immutable;
use Symfony\Component\Uid\UuidV4;

#[Immutable]
final class DeleteCommand extends AbstractCommand
{
    public function __construct(private UuidV4 $id, private UuidV4 $person)
    {
    }

    public function id(): UuidV4
    {
        return $this->id;
    }

    public function person(): UuidV4
    {
        return $this->person;
    }
}
