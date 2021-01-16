<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Person\Argument;

use Symfony\Component\String\UnicodeString;

final class Create
{
    private UnicodeString $id;

    private UnicodeString $region;

    public function __construct(UnicodeString $id, UnicodeString $region)
    {
        $this->id = $id;
        $this->region = $region;
    }

    public function id(): UnicodeString
    {
        return $this->id;
    }

    public function region(): UnicodeString
    {
        return $this->region;
    }
}
