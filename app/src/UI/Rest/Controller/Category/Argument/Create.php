<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Category\Argument;

use Symfony\Component\String\UnicodeString;

final class Create
{
    private UnicodeString $name;

    private UnicodeString $color;

    public function __construct(UnicodeString $name, UnicodeString $color)
    {
        $this->name = $name;
        $this->color = $color;
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
