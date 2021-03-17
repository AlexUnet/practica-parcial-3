<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Cable;
use App\Entity\Telephony;
use App\Entity\Internet;
use App\Entity\Package;

class PackageController extends AbstractController
{
    /**
     * @Route("/package/", name="package")
     */
    public function index(): Response
    {
        $cables = $this->getDoctrine()
            ->getRepository(Cable::class)
            ->findAll();
        
        $telephonies = $this->getDoctrine()
            ->getRepository(Telephony::class)
            ->findAll();

        $internets = $this->getDoctrine()
            ->getRepository(Internet::class)
            ->findAll();


        $cablesNames = [];
        $telephoniesNames = [];
        $internetsNames = [];

        foreach ($cables as $cable) 
            $cablesNames[] = $cable->getName();
        foreach ($telephonies as $telephony)
            $telephoniesNames[] = $telephony->getMinutes();
        foreach ($internets as $internet)
            $internetsNames[] = $internet->getSpeed();

        return $this->render('package/index.html.twig', [
            'cables' => $cablesNames,
            'telephonies' => $telephoniesNames,
            'internets' => $internetsNames,
        ]);
    }

    /**
     * @Route("/package/create", name="createPackage", methods="POST")
     */
    public function createPackage(){
        $package = new Package();
        $package->setName($_POST['name']);
        $totalPrice = 0;

        if($_POST['cable'] !== ''){
            $cable = $this->getDoctrine()
            ->getRepository(Cable::class)
            ->findOneBy(['name' => $_POST['cable']]);
            $totalPrice += $cable->getPrice();
            $package->setCable($cable);
        }
        if($_POST['telephony'] !== ''){
            $telephony = $this->getDoctrine()
            ->getRepository(Telephony::class)
            ->findOneBy(['minutes' => $_POST['telephony']]);
            $totalPrice += $telephony->getPrice();
            $package->setTelephony($telephony);
        }
        if($_POST['internet'] !== ''){
            $internet = $this->getDoctrine()
            ->getRepository(Internet::class)
            ->findOneBy(['speed' => $_POST['internet']]);
            $totalPrice += $internet->getPrice();
            $package->setInternet($internet);
        }
            
        $package->setPrice($totalPrice);
        
        try {
            $newPackage = $this->getDoctrine()->getManager();
            $newPackage->persist($package);
            $newPackage->flush();

            return $this->render('package/create.html.twig');
        } catch (\Throwable $th) {
            return $this->render('package/errorCreate.html.twig');
        }
    }
}
