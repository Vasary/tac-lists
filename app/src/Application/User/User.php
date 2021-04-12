<?php

declare(strict_types=1);

namespace App\Application\User;

use App\Domain\Person\Model\Person as DomainUser;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\UuidV4;

final class User implements UserInterface, PasswordUpgraderInterface
{
    private ?DomainUser $domainUser;

    public function __construct(?DomainUser $appUser)
    {
        $this->domainUser = $appUser;
    }

    public function getId(): ?UuidV4
    {
        if (null === $this->domainUser) {
            return null;
        }

        return $this->domainUser->id();
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function getPassword(): ?string
    {
        if (null === $this->domainUser) {
            return null;
        }

        return $this->domainUser->getPassword();
    }

    public function getSalt(): ?string
    {
        return null;
    }

    public function getUsername(): ?string
    {
        if (null === $this->domainUser) {
            return null;
        }

        return (string)$this->domainUser->id();
    }

    public function eraseCredentials(): void
    {
    }

    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
    }

    public function getDomainUser(): ?DomainUser
    {
        if (null === $this->domainUser) {
            return null;
        }

        return $this->domainUser;
    }
}