<?php

declare(strict_types=1);

namespace App\Infrastructure\Trait;

use App\Domain\Exception\PermissionDeniedException;
use App\Domain\Person\Model\Person;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Uid\UuidV4;

trait ObjectAccess
{
    protected function hasPermission(Collection $membersList, UuidV4 $initiator, UuidV4 $object): void
    {
        $isInitiatorMemberOfList =
            $membersList
                ->exists(fn (int $_, Person $person) => $person->id()->toBinary() === $initiator->toBinary())
        ;

        if (!$isInitiatorMemberOfList) {
            throw new PermissionDeniedException($initiator, $object);
        }
    }
}
