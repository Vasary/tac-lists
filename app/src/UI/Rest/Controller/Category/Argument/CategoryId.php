<?php

declare(strict_types=1);

namespace App\UI\Rest\Controller\Category\Argument;

use Symfony\Component\String\UnicodeString;

final class CategoryId
{
    public function __construct(private UnicodeString $id)
    {
    }

    public function id(): UnicodeString
    {
        return $this->id;
    }
}
