<?php

namespace App\Form;

use App\Entity\Instrument;
use App\Entity\Emprunter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class EmpruntType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('dateDebut', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                 ])
            ->add('dateRetour', DateType::class, [
                 'widget' => 'single_text',
                 'format' => 'yyyy-MM-dd',
                 ])
            ->add('instrument', EntityType::class, array('class' => 'App\Entity\Instrument','choice_label' => 'intitule' ))
            //>add('eleve', EntityType::class, array('class' => 'App\Entity\Eleve','choice_label' => 'nom' ))
            ->add('enregistrer', SubmitType::class, array('label' => 'Enregistrer'));
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Emprunter::class,
        ]);
    }
}
