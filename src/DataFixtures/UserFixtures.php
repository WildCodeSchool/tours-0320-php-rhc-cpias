<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        // Création d’un User de type “user”
        $user = new User();
        $user->setUsername('user');
        $user->setRoles(['ROLE_USER']);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'userpassword'
        ));

        $manager->persist($user);

        // Création d’un User de type “technician”
        $technician = new User();
        $technician->setUsername('technician');
        $technician->setRoles(['ROLE_TECHNICIAN']);
        $technician->setPassword($this->passwordEncoder->encodePassword(
            $technician,
            'technicianpassword'
        ));

        $manager->persist($technician);

        $manager->flush();
    }
}
