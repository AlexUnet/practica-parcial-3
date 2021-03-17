<?php

namespace App\Controller;

if (!isset($_SESSION)) {
    session_start();
}

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
     */
    public function create()
    {
        $user = new User();
        $user->setIsAdmin(false);
        $user->setName($_POST['name']);
        $user->setLastName($_POST['lastName']);
        $user->setPassword($_POST['password']);
        $user->setMail($_POST['mail']);
        $user->setPhoneNumber($_POST['phone']);

        try {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->render('user/create.html.twig');
        } catch (\Throwable $th) {
            return $this->render('user/errorCreate.html.twig');
        }
    }

    /**
     * @Route("/user/login", methods="GET")
     */
    public function login()
    {
        return $this->render("user/login.html.twig");
    }
    /**
     * @Route("/user/login", methods="POST")
     */
    public function validateValues()
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->findOneBy(['mail' => $_POST['mail'], 'password' => $_POST['password']]);

        if (!$user) {
            return $this->render("user/notfound.html.twig");
        } else {
            $_SESSION['user'] = $user;
            return $this->forward('App\Controller\DashboardController::fancy');
        }
    }

    /**
     * @Route("/user/singUp", methods="GET")
     */
    public function singUp()
    {
        return $this->render("user/singup.html.twig");
    }
    /**
     * @Route("/user/singUp", methods="GET")
     */
    public function userList()
    {
    }
}
