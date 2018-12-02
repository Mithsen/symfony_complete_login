<?php

namespace App\Controller;

use App\services\PageRoutingServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{


    /**
     * @Route("myInfoPage" ,name = "myInfoPage")
     */
    public function myInfoPage(Request $request, PageRoutingServices $pageRoutingServices)
    {
        $emp = $pageRoutingServices->getEmp($request->getSession()->get('user'));

        if($emp!=null)
        {
            return $this->render('page/myInfoPage.html.twig', [
                'firstname' => $emp->getFirstName(),
                'lastname' => $emp->getLastName(),
                'address' => $emp->getAddress(),
            ]);
        }
        return $this->redirectToRoute('login' );
    }


    /**
     * @Route("empIDPage",name="empIDPage")
     */
    public function empIDPage(Request $request, PageRoutingServices $pageRoutingServices)
    {
        $emp = $pageRoutingServices->getEmp($request->getSession()->get('user'));

        if($emp!=null)
        {
            return $this->render('page/empIDPage.html.twig');
        }
        return $this->redirectToRoute('login' );
    }


    /**
     * @Route("leavePage",name="leavePage")
     */
    public function leavePage(Request $request, PageRoutingServices $pageRoutingServices)
    {
        $emp = $pageRoutingServices->getEmp($request->getSession()->get('user'));

        if($emp!=null)
        {
            return $this->render('page/leavePage.html.twig');
        }
        return $this->redirectToRoute('login' );
    }

}
