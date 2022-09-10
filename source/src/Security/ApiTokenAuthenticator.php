<?php

namespace App\Security;

use App\Repository\UserRepository;
use App\Traits\ResponserTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;

class ApiTokenAuthenticator extends AbstractAuthenticator
{
    use ResponserTrait;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function supports(Request $request): ?bool
    {
        return $request->headers->has('token');
    }

    public function authenticate(Request $request): Passport
    {
        $apiToken = $request->headers->get('token');
        if (null === $apiToken) {
            throw new CustomUserMessageAuthenticationException('Authentication failed.');
        }

        return new SelfValidatingPassport(new UserBadge($apiToken, function() use($apiToken) {
            $user = $this->userRepository->findByApiToken($apiToken);
            
            if(empty($user)){
                throw new UserNotFoundException();
            }
            return $user;
        }));
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $data = [
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())
        ];

        return $this->errorResponse($data, Response::HTTP_UNAUTHORIZED);
    }

}
