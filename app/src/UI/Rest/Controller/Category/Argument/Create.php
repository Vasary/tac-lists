<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Category\Argument;

use Symfony\Component\String\UnicodeString;

final class Create
{
    public function __construct(
        private UnicodeString $name,
        private UnicodeString $color
    ) {
    }

    public function name(): UnicodeString
    {
        return $this->name;
    }

    public function color(): UnicodeString
    {
        return $this->color;
    }
}
