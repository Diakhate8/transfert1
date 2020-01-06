<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user->setPrenom('Abdou');
        $user->setNom('gueye');              
        // $user->setRole('1');        
        $user->setUsername('Admin_Syst');
        $user->setPassword($this->passwordEncoder->encodePassword($user,'admin'));
        $user->setRoles(json_encode(array("ROLE_SUPER_ADMIN"))); 
        $user->setStatus(true);       

        $manager->persist($user);

        $user1 = new User();
        $user1->setPrenom('Amadou');
        $user1->setNom('Sarr');                    
        $user1->setUsername('Admin1');
        $user1->setPassword($this->passwordEncoder->encodePassword($user1,'admin1'));
        $user1->setRoles(json_encode(array("ROLE_ADMIN"))); 
        $user1->setStatus(true);

        $manager->persist($user1) ;

        $user2 = new User();
        $user2->setPrenom('Amadou');
        $user2->setNom('Sarr');                    
        $user2->setUsername('caissier1');
        $user2->setPassword($this->passwordEncoder->encodePassword($user2,'caissier1'));
        $user2->setRoles(array("ROLE_USER")); 
        $user2->setStatus(true);
        ;
        $manager->persist($user2);


        $manager->flush();

        $data = [
            'status' => 201,
            'message' => 'L\'utilisateur a été créé'
        ];

        return new JsonResponse($data, 201);

    }

    
}
