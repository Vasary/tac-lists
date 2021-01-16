<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Category\Argument;

use Symfony\Component\String\UnicodeString;

final class CategoryId
{
    private UnicodeString $id;

    public function __construct(UnicodeString $id)
    {
        $this->id = $id;
    }

    public function id(): UnicodeString
    {
        return $this->id;
    }
}
