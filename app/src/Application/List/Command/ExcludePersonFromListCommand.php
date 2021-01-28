<?php

declare(strict_types=1);

namespace App\Application\List\Command;

use App\Domain\Command\AbstractCommand;
use Symfony\Component\Uid\UuidV4;

final class ExcludePersonFromListCommand extends AbstractCommand
{
    public function __construct(
        private UuidV4 $list,
        private UuidV4 $person,
        private UuidV4 $initiator
    ) {
    }

    public function list(): UuidV4
    {
        return $this->list;
    }

    public function person(): UuidV4
    {
        return $this->person;
    }

    public function initiator(): UuidV4
    {
        return $this->initiator;
    }
}
