<?php

declare(strict_types=1);

namespace App\Application\Security\Authenticator;

use App\Application\ValueObject\ApplicationResponse;
use App\Domain\SystemCodes;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

final class TokenAuthenticator extends AbstractGuardAuthenticator
{
    private const TOKEN_HEADER = 'X-PERSON-ID';

    public function supports(Request $request): bool
    {
        return $request->headers->has(self::TOKEN_HEADER);
    }

    public function getCredentials(Request $request)
    {
        return $request->headers->get(self::TOKEN_HEADER);
    }

    public function getUser($credentials, UserProviderInterface $userProvider): ?UserInterface
    {
        if (null === $credentials) {
            return null;
        }

        return $userProvider->loadUserByUsername($credentials);
    }

    public function checkCredentials($credentials, UserInterface $user): bool
    {
        return true;
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): Response
    {
        $response = new ApplicationResponse('Access denied', SystemCodes::ACCESS_DENIED);

        return new JsonResponse($response, Response::HTTP_UNAUTHORIZED);
    }

    public function start(Request $request, AuthenticationException $authException = null): Response
    {
        $response = new ApplicationResponse('Authentication required', SystemCodes::ACCESS_DENIED);

        return new JsonResponse($response, Response::HTTP_UNAUTHORIZED);
    }

    public function supportsRememberMe(): bool
    {
        return false;
    }
}
