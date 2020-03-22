<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EMusicController extends AbstractController
{
    /**
     * @Route("/e/music", name="e_music")
     */
    public function index()
    {
         return $this->render('accueil.html.twig');
    }
}
