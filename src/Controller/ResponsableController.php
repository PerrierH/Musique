<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Responsable;
use App\Form\ResponsableType;
use App\Entity\Eleve;
use Symfony\Component\HttpFoundation\Request;


class ResponsableController extends AbstractController
{
    /**
     * @Route("/responsable", name="responsable")
     */
    public function index()
    {
        $responsable='test';
        return $this->render('Responsable/accueil.html.twig', [

            'Responsable' => $responsable,
        ]);
    }


	public function ajouterResponsable(Request $request){

    $responsable = new responsable();
    $form = $this->createForm(ResponsableType::class, $responsable);
    $form->handleRequest($request);

	if ($form->isSubmitted() && $form->isValid()) {

            $responsable = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($responsable);
            $entityManager->flush();

	    return $this->render('responsable/consulterAjout.html.twig', ['responsable' => $responsable,]);
	}
	else
        {
            return $this->render('responsable/ajouter.html.twig', array('form' => $form->createView(),));
	}

        }

        public function consulterResponsable($id){

            $responsable = $this->getDoctrine()
            ->getRepository(Responsable::class)
            ->find($id);

            if (!$responsable) {
                throw $this->createNotFoundException(
                'Aucun responsable trouvé avec le numéro '.$id
                );
            }

            //return new Response('Responsable : '.$responsable->getNom());
            return $this->render('responsable/consulter.html.twig', [
                'responsable' => $responsable,]);
        }
        public function listerResponsable(){
            $repository = $this->getDoctrine()->getRepository(Responsable::class);
            $responsable = $repository->findAll();
            return $this->render('responsable/lister.html.twig', [
                'pResponsable' => $responsable,]);

        }
    /**     * @Route("/responsable/listerEleve/{idResponsable}", name="listerEleve")
	*/
        public function listerEleve($idResponsable){

            $responsable = $this->getDoctrine()
            ->getRepository(Responsable::class)
            ->find($idResponsable);
            //var_dump($responsable);

            /*$eleves = $this->getDoctrine()
            ->getRepository(Eleve::class)
            ->findByResponsable(1);*/

            return $this->render('responsable/listerEleve.html.twig', [
                'pResponsable' => $responsable,]);

        }

}
