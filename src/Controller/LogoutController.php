<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LogoutController extends AbstractController
{
    /**
     * @Route("/logout", name="logout")
     */
    public function logout() {

        $this->get('session')->remove('user');
        return $this->redirectToRoute('login' );
    }
}
