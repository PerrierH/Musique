<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Accessoire;
use App\Form\AccessoireType;
use App\Form\AccessoireModifierType;


class AccessoireController extends AbstractController
{
    /**
     * @Route("/accessoire", name="accessoire")
     */
    public function index()
    {
        return $this->render('accessoire/index.html.twig', [
            'controller_name' => 'AccessoireController',
        ]);
    }

    public function ajouterAccessoire(Request $request){

        // instanciation d'un objet Etudiant
        $accessoire = new Accessoire();
        $form = $this->createForm(AccessoireType::class, $accessoire);
	      $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $accessoire = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($accessoire);
            $entityManager->flush();

	          return $this->render('accessoire/consulterAjout.html.twig', ['accessoire' => $accessoire,]);
        	}
        	else
          {
              return $this->render('accessoire/ajouter.html.twig', array('form' => $form->createView(),));
        	}

	     }

       public function modifierAccessoire($id, Request $request){

      //récupération de l'étudiant dont l'id est passé en paramètre
      $accessoire = $this->getDoctrine()
          ->getRepository(Accessoire::class)
          ->find($id);

          	if (!$accessoire) {
          	    throw $this->createNotFoundException('Aucun accessoire trouvé avec le numéro '.$id);
          	}
          	else
          	{
            $form = $this->createForm(AccessoireModifierType::class, $accessoire);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                 $accessoire = $form->getData();
                 $entityManager = $this->getDoctrine()->getManager();
                 $entityManager->persist($accessoire);
                 $entityManager->flush();
                 return $this->render('accessoire/consulter.html.twig', ['accessoire' => $accessoire,]);
           }
           else{
                return $this->render('accessoire/ajouter.html.twig', array('form' => $form->createView(),));
           }
        }
 }
 public function listerAccessoire(){
   $repository = $this->getDoctrine()->getRepository(Accessoire::class);
   $accessoire = $repository->findAll();
   return $this->render('accessoire/lister.html.twig', [
         'pAccessoire' => $accessoire,]);

}
public function consulterAccessoire($id){

    $accessoire = $this->getDoctrine()
    ->getRepository(Accessoire::class)
    ->find($id);

    if (!$accessoire) {
        throw $this->createNotFoundException(
        'Aucun accessoire trouvé avec le numéro '.$id
        );
    }
    return $this->render('accessoire/consulter.html.twig', [
        'accessoire' => $accessoire,]);
}
}
