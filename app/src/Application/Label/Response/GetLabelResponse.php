<?php

declare(strict_types=1);

namespace App\Application\Label\Response;

use App\Domain\Response\AbstractResponse;
use DateTimeImmutable;
use Symfony\Component\String\UnicodeString;

final class GetLabelResponse extends AbstractResponse
{
    private UnicodeString $id;

    private DateTimeImmutable $created;

    private DateTimeImmutable $updated;

    private UnicodeString $text;

    public function __construct(UnicodeString $id, DateTimeImmutable $created, DateTimeImmutable $updated, UnicodeString $text)
    {
        $this->id = $id;
        $this->created = $created;
        $this->updated = $updated;
        $this->text = $text;
    }
}
