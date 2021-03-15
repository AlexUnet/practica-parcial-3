<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Program;

class ProgramController extends AbstractController
{
    /**
     * @Route("/program/", name="program")
     */
    public function index(): Response
    {
        return $this->render('program/index.html.twig');
    }

    /**
     * @Route("/program/create", name="createProgram", methods="POST")
     */
    public function createProgram(){
        $program = new Program();
        $program->setName($_POST['name']);
        $program->setDays($_POST['days']);
        $program->setHour(new \DateTime($_POST['hour']));

        try {
            $newProgram = $this->getDoctrine()->getManager();
            $newProgram->persist($program);
            $newProgram->flush();

            return $this->render('program/create.html.twig');
        } catch (\Throwable $th) {
            return $this->render('program/errorCreate.html.twig');
        }


        return $this->render('program/create.html.twig');
    }
}
