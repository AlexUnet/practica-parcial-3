<?php

namespace App\Controller;

if (!isset($_SESSION)) {
    session_start();
}

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
        if($_SESSION['user']->getIsAdmin())
            return $this->render('dashboard/indexAdmin.html.twig',['sessionName' => $_SESSION['user']->getName()]);
        
        return $this->render('dashboard/index.html.twig',['sessionName' => $_SESSION['user']->getName()]);
    }

    public function fancy(){
        return $this->index();
    }
}
