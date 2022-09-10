<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\UserApiToken;
use App\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function load(ObjectManager $manager): void
    {
        $generator = Factory::create("en_US");
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setFirstName($generator->firstName());
            $user->setLastName($generator->lastName());
            $user->setEmail($generator->freeEmail());
            $user->setPassword('password');
            $manager->persist($user);
        }

        $manager->flush();
        $this->_loadUserApiTokens($manager);
    }

    private function _loadUserApiTokens(ObjectManager $manager):void
    {
        $users = $this->userRepository->findAll();
        foreach ($users as $user) {
            $userApiToken = new UserApiToken();
            $userApiToken->setUserId($user->getId());
            $date = new \DateTime('now');
            $date->modify('+1 year');
            $userApiToken->setExpireDate($date);
            $userApiToken->setCreatedAt(new \DateTimeImmutable('now'));
            $userApiToken->setToken("token-".$user->getId());
            $manager->persist($userApiToken);
        }

        $manager->flush();
    }
}
