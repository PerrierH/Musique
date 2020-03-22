<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MetierController extends AbstractController
{
    /**
     * @Route("/metier", name="metier")
     */
    public function index()
    {
        return $this->render('metier/index.html.twig', [
            'controller_name' => 'MetierController',
        ]);
    }
}
