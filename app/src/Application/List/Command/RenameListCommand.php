<?php

declare(strict_types=1);

namespace App\Application\List\Command;

use Symfony\Component\String\UnicodeString;
use Symfony\Component\Uid\UuidV4;

final class RenameListCommand
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
