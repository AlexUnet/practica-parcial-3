<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user/", name="user")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig');
    }

    /**
     * @Route("/user/create", name="createUser", methods="POST")
     * 
     */
    public function create(){
        
        $user = new User();              
        $user->setIsAdmin(false);
        $user->setName($_POST['name']);
        $user->setLastName($_POST['lastName']);
        $user->setPassword($_POST['password']);
        $user->setMail($_POST['mail']);
        $user->setPhoneNumber($_POST['phone']);

        $entityManager = $this->getDoctrine()->getManager();  
        $entityManager->persist($user);
        $entityManager->flush();

        return $this->render('user/create.html.twig');
    }
}