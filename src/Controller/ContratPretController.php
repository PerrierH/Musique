<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContratPretController extends AbstractController
{
    /**
     * @Route("/contrat/pret", name="contrat_pret")
     */
    public function index()
    {
        return $this->render('contrat_pret/index.html.twig', [
            'controller_name' => 'ContratPretController',
        ]);
    }
}
