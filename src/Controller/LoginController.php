<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginFormType;
use App\services\LoginServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
    /**
     * @Route("login", name="login")
     */
    public function index(Request $request , LoginServices $loginService)
    {
        $form = $this->createForm(LoginFormType::class, new User());

        $msg = $loginService->getAuthenticatordMsg($form,$request);

        if($msg == "success"){

            return $this->redirectToRoute('myInfoPage' );

        }
        return $this->render('login/index.html.twig', array(

            'error' => $msg ,
            'form' =>$form->createView(),
        ));
    }
}
