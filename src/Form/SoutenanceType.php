<?php

namespace App\Form;

use App\Entity\Etudiant;
use App\Entity\Soutenance;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SoutenanceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_soutenance', null, [
                'widget' => 'single_text',
                'label' => 'Date de Soutenance',
                'required' => true
            ])
            ->add('Note', NumberType::class,[
                'label' => 'Score',
                'attr' => [
                'placeholder' => 'Entez la notre entre 0 et 20'],
                'required' => true
            ])
            ->add('enseignant', EntityType::class, [
                'class' => Enseignant::class,
                'choice_label' => function($etudiant) {
                                return $etudiant->getNom() . ' ' . $etudiant->getPrenom(); // Affiche nom et prénom
                                },
                'label' => 'Enseignat'
            ])
            ->add('etudiants', EntityType::class, [
                'class' => Etudiant::class,
                'choice_label' => function($etudiant) {
                                return $etudiant->getNom() . ' ' . $etudiant->getPrenom(); // Affiche nom et prénom
                                },
                'multiple' => true,
                'expanded' => true,
                'label' => 'Etudiants',
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
