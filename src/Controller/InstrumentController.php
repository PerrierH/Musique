<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Instrument;
use App\Form\InstrumentType;
use App\Form\InstrumentModifierType;
use Symfony\Component\HttpFoundation\Request;

class InstrumentController extends AbstractController
{
    /**
     * @Route("/instrument", name="instrument")
     */
    public function index()
    {
      /* Cette simple instruction permet d'envoyer des informations au navigateur sans passer par une vue.
      return new Response('<html><body>Salut Les SIO</body></html>');
      */

       // initialise une variable qui sera exploitée dans la vue
       $annee = '2020';
       return $this->render('instrument/index.html.twig', ['pAnnee' => $annee]);
    }


    public function ajouterInstrument(Request $request){

	// récupère le manager d'entités
        $entityManager = $this->getDoctrine()->getManager();

        // instanciation d'un objet Etudiant
        $instrument = new Instrument();
        $form = $this->createForm(InstrumentType::class, $instrument);
	      $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $instrument = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($instrument);
            $entityManager->flush();

	          return $this->render('instrument/consulterAjout.html.twig', ['instrument' => $instrument,]);
        	}
        	else
          {
              return $this->render('instrument/ajouter.html.twig', array('form' => $form->createView(),));
        	}

	     }

    public function consulterInstrument($id){

		$instrument = $this->getDoctrine()
        ->getRepository(Instrument::class)
        ->find($id);

		if (!$instrument) {
			throw $this->createNotFoundException(
            'Aucun instrument trouvé avec le numéro '.$id
			);
		}

		//return new Response('Instrument : '.$Instrument->getNom());
		return $this->render('instrument/consulter.html.twig', [
            'instrument' => $instrument,]);
	}

  public function listerInstrument(){
		$repository = $this->getDoctrine()->getRepository(Instrument::class);
		$instruments = $repository->findAll();
		return $this->render('instrument/lister.html.twig', [
            'pInstruments' => $instruments,]);

	}

  /**
	* @Route("/instrument/listerParAccessoire/{accessoire}", name="listerAccessoireParInstrument")
	*/
  public function listerAccessoire($idInstrument){

      $instrument = $this->getDoctrine()
      ->getRepository(Instrument::class)
      ->find($idInstrument);
      //var_dump($responsable);


      return $this->render('instrument/lister.html.twig', [
          'pInstruments' => $instruments,]);

  }

  public function modifierInstrument($id, Request $request){

    //récupération de l'étudiant dont l'id est passé en paramètre
    $instrument = $this->getDoctrine()
        ->getRepository(Instrument::class)
        ->find($id);

	if (!$instrument) {
	    throw $this->createNotFoundException('Aucun instrument trouvé avec le numéro '.$id);
	}
	else
	{
            $form = $this->createForm(InstrumentModifierType::class, $instrument);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                 $instrument = $form->getData();
                 $entityManager = $this->getDoctrine()->getManager();
                 $entityManager->persist($instrument);
                 $entityManager->flush();
                 return $this->render('instrument/consulter.html.twig', ['instrument' => $instrument,]);
           }
           else{
                return $this->render('instrument/ajouter.html.twig', array('form' => $form->createView(),));
           }
        }
 }
}
