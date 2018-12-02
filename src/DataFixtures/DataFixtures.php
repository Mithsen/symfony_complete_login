<?php

namespace App\DataFixtures;

use App\Entity\Employee;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DataFixtures extends Fixture
{
    private $passwordEncoder;
    private $entityManager;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->entityManager = $entityManager;
    }
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        // create 20 products! Bam!

        $connection = $this->entityManager->getConnection();
        $platform   = $connection->getDatabasePlatform();

        $connection->executeUpdate($platform->getTruncateTableSQL('user', true));
        $connection->executeUpdate($platform->getTruncateTableSQL('employee', true));

        $first_names = array("admin","Johon","Krist","Malith","Namal","Dinidu");
        $last_names = array("password","Doi","Paris","Senavira","Kumara","Senarathna");
        $addresses = array("a street, US","b street, AUS","c street, Sri Lanka","d street, India","e street, Sri Lanka" );

        for ($i = 0; $i < 5; $i++) {

            $emp = new Employee();
            $emp->setFirstName($first_names[$i]);
            $emp->setLastName($last_names[$i]);
            $emp->setAddress($addresses[$i]);
            $manager->persist($emp);
            //$manager->flush();

            $user = new User();
            $email = $first_names[$i].'@gmail.com';
            $user->setEmail($email);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                $last_names[$i]
            ));
            $user->setEmpId($i+1);
            $manager->persist($user);
        }

        $manager->flush();

    }
}
