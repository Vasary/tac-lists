<?php

declare(strict_types=1);

namespace App\Application\Template\Query;

use App\Domain\Query\AbstractQuery;
use Symfony\Component\Uid\UuidV4;

final class GetTemplateQuery extends AbstractQuery
{
    public function __construct(private UuidV4 $id, private UuidV4 $person)
    {
    }

    public function id(): UuidV4
    {
        return $this->id;
    }

    public function person(): UuidV4
    {
        return $this->person;
    }
}
