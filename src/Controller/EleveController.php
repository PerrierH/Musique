<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Eleve;
use App\Form\EleveType;
use Symfony\Component\HttpFoundation\Request;
use App\Form\EleveModifierType;


class EleveController extends AbstractController
{
    /*
     * @Route("/etudiant", name="etudiant")
     */
    public function index()
    {
        /* Cette simple instruction permet d'envoyer des informations au navigateur sans passer par une vue.
        return new Response('<html><body>Salut Les SIO</body></html>');
        */

         // initialise une variable qui sera exploitée dans la vue
         $annee = '2020';
         return $this->render('eleve/accueil.html.twig', ['pAnnee' => $annee,
        ]);
    }

    public function consulterEleve($id){

        $eleve = $this->getDoctrine()
        ->getRepository(Eleve::class)
        ->find($id);

        if (!$eleve) {
            throw $this->createNotFoundException(
            'Aucun eleve trouvé avec le numéro '.$id
            );
        }

        //return new Response('Etudiant : '.$eleve->getNom());
        return $this->render('eleve/consulter.html.twig', [
            'eleve' => $eleve,]);
    }

    public function listerEleve(){
        $repository = $this->getDoctrine()->getRepository(Eleve::class);
        $eleves = $repository->findAll();
        return $this->render('eleve/lister.html.twig', [
            'pEleves' => $eleves,]);

    }

   public function ajouterEleve(Request $request){
        $eleve = new eleve();
        $form = $this->createForm(EleveType::class, $eleve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

                $eleve = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($eleve);
                $entityManager->flush();

            return $this->render('eleve/consulterAjout.html.twig', ['eleve' => $eleve,]);
        }
        else
            {
                return $this->render('eleve/ajouter.html.twig', array('form' => $form->createView(),));
            }
    }

    public function modifierEleve($id, Request $request){

    //récupération de l'étudiant dont l'id est passé en paramètre
    $eleve = $this->getDoctrine()
        ->getRepository(Eleve::class)
        ->find($id);

            if (!$eleve) {
                throw $this->createNotFoundException('Aucun eleve trouvé avec le numéro '.$id);
            }
            else
            {
            $form = $this->createForm(EleveModifierType::class, $eleve);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                 $eleve = $form->getData();
                 $entityManager = $this->getDoctrine()->getManager();
                 $entityManager->persist($eleve);
                 $entityManager->flush();
                 return $this->render('eleve/consulter.html.twig', ['eleve' => $eleve,]);
           }
           else{
                return $this->render('eleve/ajouter.html.twig', array('form' => $form->createView(),));
           }
        }

}
/**     * @Route("/eleve/listerResponsable/{idEleve}", name="listerResponsable")
	*/
    public function listerResponsable($idEleve){

        $eleve = $this->getDoctrine()
        ->getRepository(Eleve::class)
        ->find($idEleve);
        //var_dump($responsable);

        /*$eleves = $this->getDoctrine()
        ->getRepository(Eleve::class)
        ->findByResponsable(1);*/

        return $this->render('responsable/listerResponsable.html.twig', [
            'pEleve' => $eleve,]);

    }

}
