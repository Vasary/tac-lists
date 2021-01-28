<?php

declare(strict_types=1);

namespace App\Application\List\Command;

use App\Domain\Command\AbstractCommand;
use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class RenameListCommand extends AbstractCommand
{
    public function __construct(
        private UuidV4 $list,
        private UuidV4 $initiator,
        private UnicodeString $name
    ) {
    }

    public function list(): UuidV4
    {
        return $this->list;
    }

    public function initiator(): UuidV4
    {
        return $this->initiator;
    }

    public function name(): UnicodeString
    {
        return $this->name;
    }
}
