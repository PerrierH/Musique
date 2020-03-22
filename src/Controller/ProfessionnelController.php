<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Professionnel;
use App\Form\ProfessionnelType;
use App\Form\ProfessionnelModifierType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\TextType;

class ProfessionnelController extends AbstractController
{
    /**
     * @Route("/professionnel", name="professionnel")
     */
    public function index()
    {
        return $this->render('professionnel/index.html.twig', [
            'controller_name' => 'ProfessionnelController',
        ]);
    }

    public function listerProfessionnel(){
        $repository = $this->getDoctrine()->getRepository(Professionnel::class);
        $professionnel = $repository->findAll();
        return $this->render('professionnel/lister.html.twig', [
            'pProfessionnel' => $professionnel,]);

    }

    public function consulterProfessionnel($id){

  		$professionnel = $this->getDoctrine()
          ->getRepository(Professionnel::class)
          ->find($id);

  		if (!$professionnel) {
  			throw $this->createNotFoundException(
              'Aucun professeur trouvé avec le numéro '.$id
  			);
  		}

  		//return new Response('Professeur : '.$professeur->getNom());
  		return $this->render('professionnel/consulter.html.twig', [
              'professionnel' => $professionnel,]);
  	}

    public function ajouterProfessionnel(Request $request){

        $professionnel = new professionnel();
		$form = $this->createForm(ProfessionnelType::class, $professionnel);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

            $professionnel = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($professionnel);
            $entityManager->flush();

			return $this->render('professionnel/consulterAjout.html.twig', ['professionnel' => $professionnel,]);
		}
		else
        {
            return $this->render('professionnel/ajouter.html.twig', array('form' => $form->createView(),));
		}
	}

  public function modifierProfessionnel($id, Request $request){

    //récupération de l'étudiant dont l'id est passé en paramètre
    $professionnel = $this->getDoctrine()
        ->getRepository(Professionnel::class)
        ->find($id);

	if (!$professionnel) {
	    throw $this->createNotFoundException('Aucun professionnel trouvé avec le numéro '.$id);
	}
	else
	{
            $form = $this->createForm(ProfessionnelModifierType::class, $professionnel);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                 $professionnel = $form->getData();
                 $entityManager = $this->getDoctrine()->getManager();
                 $entityManager->persist($professionnel);
                 $entityManager->flush();
                 return $this->render('professionnel/consulter.html.twig', ['professionnel' => $professionnel,]);
           }
           else{
                return $this->render('professionnel/modif.html.twig', array('form' => $form->createView(),));
           }
        }
 }
 public function supprimerProfessionnel($id, Request $request){

   $professionnel = $this->getDoctrine()->getManager();
   $post = $professionnel->getRepository(Professionnel::class)->find($id);

   $professionnel->remove($post);
   $professionnel->flush();
   
   return $this->render('professionnel/lister.html.twig', [
       'pProfessionnel' => $professionnel,]);

 }
}
