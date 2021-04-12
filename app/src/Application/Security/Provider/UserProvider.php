<?php

declare(strict_types=1);

namespace App\Application\Security\Provider;

use App\Application\User\User as SymfonyUser;
use App\Domain\Person\Repository\PersonRepositoryInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Uid\UuidV4;
use function get_class;

final class UserProvider implements UserProviderInterface, PasswordUpgraderInterface
{
    public function __construct(private PersonRepositoryInterface $userRepository)
    {
    }

    public function loadUserByUsername(string $username): UserInterface
    {
        $appUser = $this->userRepository->get(UuidV4::fromString($username));

        if (null === $appUser) {
            throw new UsernameNotFoundException(
                sprintf('Username "%s" does not exist.', $username)
            );
        }

        return new SymfonyUser($appUser);
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        if (!$user instanceof SymfonyUser) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        $username = (string)$user->getId();

        return $this->loadUserByUsername($username);
    }

    public function supportsClass(string $class): bool
    {
        return SymfonyUser::class === $class;
    }

    public function upgradePassword(UserInterface $user, string $newEncodedPassword): void
    {
        /** @var SymfonyUser $user */
        $user->upgradePassword($user, $newEncodedPassword);
    }
}
