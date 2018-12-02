<?php
/**
 * Created by PhpStorm.
 * User: Mithsen
 * Date: 2018-12-01
 * Time: 10:23 AM
 */

namespace App\services;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LoginServices
{
    private $passwordEncoder;
    private $entityManager;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->entityManager = $entityManager;
    }

    public function getAuthenticatordMsg($form,$request)
    {
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $this->getCredentials($form->getData());

            if (!$user) {

                return "Username does not exist";
            }
            else {

                if ($this->checkPassword($user,$form->getData()->getPassword()))
                {

                    $request->getSession()->set('user', $user);
                    return "success";

                }
                return "Username or Password not valid";
            }
        }
        return '';
    }

    public function getCredentials($formCredentials)
    {
        $repository = $this->entityManager->getRepository(User::class);
        return $repository->findOneBy(['email' => $formCredentials->getEmail()]);
    }

    public function checkPassword($user,$form_pw)
    {
        if($this->passwordEncoder->isPasswordValid($user,$form_pw))
        {
            return true;
        }
        return false;
    }


}