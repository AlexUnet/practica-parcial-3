<?php

namespace App\Controller;

if (!isset($_SESSION)) {
    session_start();
}

use App\Entity\ChangeRequest;
use App\Entity\Package;
use App\Entity\User;
use DateTime;
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
        $changeList = $this->buildRequestsList($_SESSION['user']->getIsAdmin());
        if ($_SESSION['user']->getIsAdmin())
            return $this->render('change_request/changeRequestsAdmin.html.twig', ['changeRequestList' => $changeList]);
        else
            return $this->render('change_request/changeRequest.html.twig', ['changeRequestList' => $changeList]);
    }

    public function buildRequestsList($admin)
    {
        if ($admin)
            return $this->getDoctrine()->getRepository(ChangeRequest::class)->findAll();
        else
            return $this->getDoctrine()->getRepository(User::class)->findOneBy(['id' => $_SESSION['user']->getId()])->getChangeRequest();
    }

    /**
     * @Route("/change/state", methods="GET")
     */
    public function setRequestState()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $request = $this->getDoctrine()->getRepository(ChangeRequest::class)->findOneBy(['id' => $_GET['requestId']]);
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['id' => $_GET['userId']]);
        $newPackage = $this->getDoctrine()->getRepository(Package::class)->findOneBy(['id' => $request->getPackage()->getId()]);
        $user->setPackage($newPackage);
        $request->setState(false);
        $entityManager->flush();
        return $this->index();        
    }
    /**
     * @Route("/change/create", methods="GET")
     */
    public function createRequest(){
        $packages = $this->getDoctrine()->getRepository(Package::class)->findAll();
        return $this->render('change_request/createChangeRequest.html.twig',['packages' => $packages]);
    }
    /**
     * @Route("/change/select", methods="GET")
     */
    public function sendNewRequest(){
        $package = $this->getDoctrine()->getRepository(Package::class)->findOneBy(['id' => $_GET['package']]);
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['id'=>$_SESSION['user']->getId()]);
        $date = new DateTime();
        $changeRequest = new ChangeRequest();
        $changeRequest->setUser($user);
        $changeRequest->setPackage($package);
        $changeRequest->setDate($date);
        $changeRequest->setState(true);

        try{
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($changeRequest);
            $entityManager->flush();
            return $this->index();
        }
        catch(\Throwable $th){
            return $this->render('change_request/errorCreate.html.twig');
        }
    }

}
