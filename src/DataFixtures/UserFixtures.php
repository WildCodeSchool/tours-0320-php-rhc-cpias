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
        // Création d’un User de type “utilisateur”
        $utilisateur = new User();
        $utilisateur->setUsername('utilisateur');
        $utilisateur->setRoles(['ROLE_UTILISATEUR']);
        $utilisateur->setPassword($this->passwordEncoder->encodePassword(
            $utilisateur,
            'userpassword'
        ));

        $manager->persist($utilisateur);

        // Création d’un User de type “responsable”
        $responsable = new User();
        $responsable->setUsername('responsable');
        $responsable->setRoles(['ROLE_RESPONSABLE']);
        $responsable->setPassword($this->passwordEncoder->encodePassword(
            $responsable,
            'responsablepassword'
        ));

        $manager->persist($responsable);

        $manager->flush();
    }
}
