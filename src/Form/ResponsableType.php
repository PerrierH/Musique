<?php

namespace App\Form;

use App\Entity\Responsable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ResponsableType extends AbstractType
{
      public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('numRue', TextType::class)
            ->add('rue', TextType::class)
            ->add('copos', TextType::class)
            ->add('ville', TextType::class)
            ->add('tel', TextType::class)
            ->add('mail', TextType::class)
          //  ->add('eleves', EntityType::class, array('class' => 'App\Entity\Eleve','choice_label' => 'nom' ))
            //->add('promotion')
	    ->add('enregistrer', SubmitType::class, array('label' => 'Nouveau responsable'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Responsable::class,
        ]);
    }
}
