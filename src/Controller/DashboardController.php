<?php

namespace App\Controller;

if (!isset($_SESSION)) {
    session_start();
}
use App\Entity\User;
use App\Entity\Package;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(): Response
    {
        if(session_status() === 1)
            session_start();
        if($_SESSION['user']->getIsAdmin())
            return $this->render('dashboard/indexAdmin.html.twig',['sessionName' => $_SESSION['user']->getName()]);
        
        return $this->render('dashboard/index.html.twig',['sessionName' => $_SESSION['user']->getName()]);
    }

    /**
     * @Route("/myPackage", name="")
     */
    public function myPackages(){
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['id'=>$_SESSION['user']->getId()]);
        $package = $user->getPackage();
        return $this->render('dashboard/myPackage.html.twig',['package' => $package]);        
    }

    public function fancy(){
        return $this->index();
    }
}
