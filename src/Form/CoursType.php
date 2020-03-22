<?php

namespace App\Form;

use App\Entity\Cours;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class CoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('libelle', TextType::class)
            ->add('ageMini', TextType::class)
            ->add('heureDebut', TextType::class)
            ->add('heureFin', TextType::class)
            ->add('nbPlaces', TextType::class)
            ->add('ageMaxi', TextType::class)
            ->add('typeCours', TextType::class)
            ->add('tranche', EntityType::class, array('class' => 'App\Entity\Tranche','choice_label' => 'libelle' ))
            ->add('professeur', EntityType::class, array('class' => 'App\Entity\Professeur','choice_label' => 'nom' ))
            ->add('jour', EntityType::class, array('class' => 'App\Entity\Jour','choice_label' => 'libelle' ) )
            ->add('enregistrer', SubmitType::class, array('label' => 'Nouveau cour'))

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}
