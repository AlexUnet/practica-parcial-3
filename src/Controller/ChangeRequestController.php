<?php

namespace App\Controller;

use App\Entity\ChangeRequest;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChangeRequestController extends AbstractController
{
    /**
     * @Route("/change/request", name="change_request")
     */
    public function index(): Response
    {
        session_start();
        $changeList = $this->buildRequestsList($_SESSION['user']->getIsAdmin());
        if($_SESSION['user']->getIsAdmin())
            return $this->render('change_request/changeRequestsAdmin.html.twig',['changeRequestList' => $changeList]);
        else
            return $this->render('change_request/changeRequest.html.twig',['changeRequestList' => $changeList]);
    }

    public function buildRequestsList($admin){
        if($admin)
            return $this->getDoctrine()->
                getRepository(ChangeRequest::class)->findAll();
        else
            return $this->getDoctrine()->
                getRepository(User::class)->findOneBy(['id' => $_SESSION['user']->getId()])->getChangeRequest();
    }
}
