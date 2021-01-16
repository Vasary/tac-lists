<?php

declare(strict_types=1);

namespace App\Application\Label\Response;

use App\Domain\Response\AbstractResponse;
use DateTimeImmutable;
use Symfony\Component\String\UnicodeString;

final class GetLabelResponse extends AbstractResponse
{
    private UnicodeString $id;

    private DateTimeImmutable $createdAt;

    private DateTimeImmutable $updatedAt;

    private UnicodeString $text;

    public function __construct(UnicodeString $id, DateTimeImmutable $createdAt, DateTimeImmutable $updatedAt, UnicodeString $text)
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->text = $text;
    }
}
