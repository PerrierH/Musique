<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ClasseInstrumentController extends AbstractController
{
    /**
     * @Route("/classe/instrument", name="classe_instrument")
     */
    public function index()
    {
        return $this->render('classe_instrument/index.html.twig', [
            'controller_name' => 'ClasseInstrumentController',
        ]);
    }
}
