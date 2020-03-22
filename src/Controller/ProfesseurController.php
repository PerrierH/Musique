<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Professeur;
use App\Form\ProfesseurType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ProfesseurModifierType;
use App\Form\TextType;




class ProfesseurController extends AbstractController{
    /*
     * @Route("/professeur", name="professeur")
     */
    public function ajouterProfesseur(Request $request){

        $professeur = new professeur();
		$form = $this->createForm(ProfesseurType::class, $professeur);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {

            $professeur = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($professeur);
            $entityManager->flush();

			return $this->render('professeur/consulterAjout.html.twig', ['professeur' => $professeur,]);
		}
		else
        {
            return $this->render('professeur/ajouter.html.twig', array('form' => $form->createView(),));
		}
	}

	public function consulterProfesseur($id){

		$professeur = $this->getDoctrine()
        ->getRepository(Professeur::class)
        ->find($id);

		if (!$professeur) {
			throw $this->createNotFoundException(
            'Aucun professeur trouvé avec le numéro '.$id
			);
		}

		//return new Response('Professeur : '.$professeur->getNom());
		return $this->render('professeur/consulter.html.twig', [
            'professeur' => $professeur,]);
	}

	public function listerProfesseur(){
		$repository = $this->getDoctrine()->getRepository(Professeur::class);
		$professeurs = $repository->findAll();
		return $this->render('professeur/lister.html.twig', [
            'pProfesseur' => $professeurs,]);

	}

	public function modifierProfesseur($id, Request $request){

            $professeur = $this->getDoctrine()
            ->getRepository(Professeur::class)
            ->find($id);

	    if (!$professeur) {
	        throw $this->createNotFoundException('Aucun professeur trouvé avec le numéro '.$id);
	    }
	    else
	    {
            $form = $this->createForm(ProfesseurModifierType::class, $professeur);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                 $professeur = $form->getData();
                 $entityManager = $this->getDoctrine()->getManager();
                 $entityManager->persist($professeur);
                 $entityManager->flush();
                 return $this->render('professeur/consulter.html.twig', ['professeur' => $professeur,]);
           }
           else{
                return $this->render('professeur/ajouter.html.twig', array('form' => $form->createView(),));
           }
        }
    }
}
