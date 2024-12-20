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
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class SoutenanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateSoutenance', DateType::class, [
                'widget' => 'single_text', 
                'format' => 'yyyy-MM-dd', 
                'label' => 'Date de Soutenance',
                'required' => true
            ])
            ->add('note', NumberType::class, [
                'constraints' => [
                    new Assert\NotBlank(['message' => 'The note is required.']),
                    new Assert\Range([
                        'min' => 0,
                        'max' => 20,
                        'notInRangeMessage' => 'The note must be between {{ min }} and {{ max }}.',
                    ]),
                ],
                'label' => 'Note',
                'attr' => [
                    'min' => 0,
                    'max' => 20,
                    'step' => 0.1,
                    'placeholder' => 'Enter a note between 0 and 20',
                ],
            ])
            ->add('enseignant', EntityType::class, [
                'class' => Enseignant::class,
                'choice_label' => function($enseignant) {
                                return $enseignant->getNom() . ' ' . $enseignant->getPrenom(); // Affiche nom et prénom
                                },
                'placeholder' => 'Sélectionnez un enseignant',
                'attr' => ['class' => 'form-select'], 
                'label' => 'Enseignant',
            ])
            ->add('etudiant', EntityType::class, [
                'class' => Etudiant::class,
                'choice_label' => function($etudiant) {
                                return $etudiant->getNom() . ' ' . $etudiant->getPrenom(); // Affiche nom et prénom
                                },
                'placeholder' => 'Sélectionnez un etudiant',
                'attr' => ['class' => 'form-select'], 
                'label' => 'Etudiant',
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
