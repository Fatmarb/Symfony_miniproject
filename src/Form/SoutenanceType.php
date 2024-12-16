<?php

namespace App\Form;

use App\Entity\Soutenance;
use App\Entity\Etudiant;
use App\Entity\Enseignant;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SoutenanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_soutenance', null, [
                'widget' => 'single_text', // This enables the HTML5 date picker
                'attr' => ['class' => 'form-control js-datepicker'], // Bootstrap calendar
                'label' => 'Date de Soutenance',
                'required' => true
            ])
            ->add('Note', NumberType::class,[
                'label' => 'Note',
                'attr' => ['class' => 'form-control',
                    'min' => 0,
                    'max' => 20,
                    'placeholder' => 'Entez la notre entre 0 et 20'],
                'required' => true
            ])
            ->add('enseignant', EntityType::class, [
                'class' => Enseignant::class,
                'choice_label' => function($etudiant) {
                                return $etudiant->getNom() . ' ' . $etudiant->getPrenom(); // Affiche nom et prénom
                                },
                'placeholder' => 'Sélectionnez un enseignant',
                'attr' => ['class' => 'form-select'], // Bootstrap styling for select
                'label' => 'Enseignant',
            ])
            ->add('etudiants', EntityType::class, [
                'class' => Etudiant::class,
                'choice_label' => function($etudiant) {
                                return $etudiant->getNom() . ' ' . $etudiant->getPrenom(); // Affiche nom et prénom
                                },
                'multiple' => true,
                'expanded' => true,
                'attr' => ['class' => 'form-select'], // Bootstrap styling
                'label' => 'Étudiants',
                'required' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Soutenance::class,
        ]);
    }
}
