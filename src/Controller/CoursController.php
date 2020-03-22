<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Cours;
use App\Entity\Jour;
use App\Entity\Professeur;
use App\Form\CoursType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\TextType;

class CoursController extends AbstractController
{
    /**
     * @Route("/cours", name="cours")
     */
    public function index()
    {
        return $this->render('cours/index.html.twig', [
            'controller_name' => 'CoursController',
        ]);
    }

    public function consulterCours($id){

        $cours = $this->getDoctrine()
        ->getRepository(Cours::class)
        ->find($id);

        if (!$cours) {
            throw $this->createNotFoundException(
            'Aucun cours trouvé avec le numéro '.$id
            );
        }

        //return new Response('Etudiant : '.$eleve->getNom());
        return $this->render('cours/consulter.html.twig', [
            'cours' => $cours,]);
    }

    public function listerCours(){
        $repository = $this->getDoctrine()->getRepository(Cours::class);
        $cours = $repository->findAll();
        return $this->render('cours/lister.html.twig', [
            'pCours' => $cours,]);

    }

   public function ajouterCours(Request $request){
        $cours = new cours();
        $form = $this->createForm(CoursType::class, $cours);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

                $cours = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($cours);
                $entityManager->flush();

            return $this->render('cours/consulterAjout.html.twig', ['cours' => $cours,]);
        }
        else
            {
                return $this->render('cours/ajouter.html.twig', array('form' => $form->createView(),));
            }
    }
}
