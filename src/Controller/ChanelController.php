<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Chanel;
use App\Entity\Program;

class ChanelController extends AbstractController
{
    /**
     * @Route("/chanel/", name="chanel")
     */
    public function index(): Response
    {
        $availablePrograms = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findBy(['chanel' => null]);

        foreach ($availablePrograms as $program) {
            $names[] = $program->getName();
        }

        return $this->render('chanel/index.html.twig', ['programs' => $names]);
    }

    /**
     * @Route("/chanel/create", name="createChanel", methods="POST")
     */
    public function createChangel(){
        $chanel = new Chanel();
        $chanel->setName($_POST['name']);

        foreach ($_POST['programs'] as $name) {
            $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findOneBy(['name' => $name]);
            $chanel->addProgram($program);
        }

        try {
            $newChanel = $this->getDoctrine()->getManager();
            $newChanel->persist($chanel);
            $newChanel->flush();

            return $this->render('chanel/create.html.twig');
        } catch (\Throwable $th) {
            return $this->render('chanel/errorCreate.html.twig');
        }
    }
}
