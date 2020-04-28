<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    public const USER_REFERENCE = 'user-gary';

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail("user@mail.com")
             ->setUsername("User")
             ->setPassword("password");
        $this->addReference(self::USER_REFERENCE, $user);

        $manager->persist($user);
        $manager->flush();
    }
}
