<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class TypeInstrumentController extends AbstractController
{
    /**
     * @Route("/type/instrument", name="type_instrument")
     */
    public function index()
    {
        return $this->render('type_instrument/index.html.twig', [
            'controller_name' => 'TypeInstrumentController',
        ]);
    }
}
