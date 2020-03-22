<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CouleurController extends AbstractController
{
    /**
     * @Route("/couleur", name="couleur")
     */
    public function index()
    {
        return $this->render('couleur/index.html.twig', [
            'controller_name' => 'CouleurController',
        ]);
    }
}
