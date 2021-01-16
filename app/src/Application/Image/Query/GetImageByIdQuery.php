<?php

declare(strict_types=1);

namespace App\Application\Image\Query;

use App\Domain\Query\AbstractQuery;
use Symfony\Component\String\UnicodeString;

final class GetImageByIdQuery extends AbstractQuery
{
    private UnicodeString $id;

    public function __construct(UnicodeString $id)
    {
        $this->id = $id;
    }

    public function getId(): UnicodeString
    {
        return $this->id;
    }
}
