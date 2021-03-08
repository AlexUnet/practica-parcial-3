<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    public function formSingUpAction(Request $request){
        $name= '';
        $lastName = '';
        $password = '';
        $mail = '';
        $phone = 0;

        return $this->render('user/index.html.twig',['name' => $name,]);
    }

    public function createUser(): Response{
        $entityManager = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setIsAdmin(false);
        $user->setName('admin');
        $user->setLastName('First');
        $user->setPassword('admin');
        $user->setMail('admin@gmail.com');
        $user->setPhoneNumber('9122890');


        $entityManager->persist($user);

        $entityManager->flush();

        return new Response('Saved new user with id'.$user->getId());
    }
}