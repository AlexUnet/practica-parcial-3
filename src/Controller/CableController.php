<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Chanel;
use App\Entity\Cable;

class CableController extends AbstractController
{
    /**
     * @Route("/cable/", name="cable")
     */
    public function index(): Response
    {
        $chanels = $this->getDoctrine()
            ->getRepository(Chanel::class)
            ->findAll();

        foreach ($chanels as $chanel) {
            $names[] = $chanel->getName();
        }

        return $this->render('cable/index.html.twig', ['chanels' => $names]);
    }

    /**
     * @Route("/cable/create", name="createCable", methods="POST")
     */
    public function createCable(){
        $cable = new Cable();
        $cable->setName($_POST['name']);
        $cable->setPrice($_POST['price']);

        foreach ($_POST['chanels'] as $name) {
            $chanel = $this->getDoctrine()
            ->getRepository(Chanel::class)
            ->findOneBy(['name' => $name]);
            $cable->addChanel($chanel);
        }

        try {
            $newCable = $this->getDoctrine()->getManager();
            $newCable->persist($cable);
            $newCable->flush();

            return $this->render('cable/create.html.twig');
        } catch (\Throwable $th) {
            return $this->render('cable/errorCreate.html.twig');
        }

    }
}
