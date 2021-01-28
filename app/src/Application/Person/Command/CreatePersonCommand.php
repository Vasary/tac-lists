<?php

declare(strict_types=1);

namespace App\Application\Person\Command;

use App\Domain\Command\AbstractCommand;
use Symfony\Component\String\UnicodeString;

final class CreatePersonCommand extends AbstractCommand
{
    private UnicodeString $personId;

    private UnicodeString $region;

    public function __construct(UnicodeString $personId, UnicodeString $region)
    {
        $this->personId = $personId;
        $this->region = $region;
    }

    public function personId(): UnicodeString
    {
        return $this->personId;
    }

    public function region(): UnicodeString
    {
        return $this->region;
    }
}
