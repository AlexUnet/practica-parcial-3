<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Internet;

class InternetController extends AbstractController
{
    /**
     * @Route("/internet/", name="internet", methods="GET")
     */
    public function index(): Response
    {
        return $this->render('internet/index.html.twig');
    }

    /**
     * @Route("/internet/create", name="createInternet", methods="POST")
     */
    public function create(){
        $internet = new Internet();
        $internet->setSpeed($_POST['speed']);
        $internet->setPrice($_POST['price']);

        $newInternet = $this->getDoctrine()->getManager();
        $newInternet->persist($internet);
        $newInternet->flush();

        return $this->render('internet/create.html.twig');
    }
}
