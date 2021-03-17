<?php

namespace App\Controller;

if (!isset($_SESSION)) {
    session_start();
}
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    public function index(): Response
    {
        // if (!isset($_SESSION)) {
        //     session_start();
        // }
        return $this->render('default/index.html.twig');
    }
}
