<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Intervention;
use App\Form\InterventionType;
use Symfony\Component\HttpFoundation\Request;

class InterventionController extends AbstractController
{

    /**
     * @Route("/intervention", name="intervention")
     */
  public function index()
    {
         $annee = '2020';
         return $this->render('intervention/index.html.twig', ['pAnnee' => $annee,
        ]);
    }

    public function ajouterIntervention(Request $request)
    {
      $intervention = new intervention();
    	$form = $this->createForm(InterventionType::class, $intervention);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {

                       $intervention = $form->getData();

                       $entityManager = $this->getDoctrine()->getManager();
                       $entityManager->persist($intervention);
                       $entityManager->flush();

           	    return $this->render('intervention/consulterAjout.html.twig', ['intervention' => $intervention,]);
           	}
           	else
                   {
                       return $this->render('intervention/ajouter.html.twig', array('form' => $form->createView(),));
           	}
	}
  public function listerIntervention(){
    $repository = $this->getDoctrine()->getRepository(Intervention::class);
    $interventions = $repository->findAll();
    return $this->render('intervention/lister.html.twig', [
        'pInterventions' => $interventions,]);
      }

      public function consulterIntervention($id){
        $intervention = $this->getDoctrine()
        ->getRepository(Intervention::class)
        ->find($id);

        if (!$intervention) {
          throw $this->createNotFoundException(
        'Aucune intervention trouvé avec le numéro '.$id
      );
    }
    //return new Response('Etudiant : '.$etudiant->getNom());
      return $this->render('intervention/consulter.html.twig', [
        'intervention' => $intervention,]);
}

}
