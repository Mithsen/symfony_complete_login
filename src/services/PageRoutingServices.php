<?php
/**
 * Created by PhpStorm.
 * User: Mithsen
 * Date: 2018-12-01
 * Time: 12:58 PM
 */

namespace App\services;

use App\Entity\Employee;
use Doctrine\ORM\EntityManagerInterface;

class PageRoutingServices
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getEmp($user) {

        if($user==null) {
            //return $this->redirectToRoute('login' );
            return null;
        }

        return $this->getEmpCredentials($user->getEmpId());
    }

    public function getEmpCredentials($id) {

        $repository = $this->entityManager->getRepository(Employee::class);
        return $repository->findOneBy(['id' => $id]);
    }


}