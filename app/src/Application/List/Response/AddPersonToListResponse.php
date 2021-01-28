<?php

declare(strict_types=1);

namespace App\Application\List\Response;

use App\Domain\Response\AbstractResponse;
use Symfony\Component\Uid\UuidV4;

final class AddPersonToListResponse extends AbstractResponse
{
    public function __construct(
        public UuidV4 $list,
        public UuidV4 $person,
        public int $status
    ) {
    }
}
