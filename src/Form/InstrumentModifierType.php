<?php

namespace App\Form;

use App\Entity\Instrument;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class InstrumentModifierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('intitule', TextType::class)
            ->add('prixAchat', TextType::class)
            ->add('dateAchat', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                 ])
            ->add('utilisation', TextType::class)
            ->add('marque', EntityType::class, array('class' => 'App\Entity\Marque','choice_label' => 'nom' ))
            ->add('couleur', EntityType::class, array('class' => 'App\Entity\Couleur','choice_label' => 'libelle' ))
            ->add('etat', EntityType::class, array('class' => 'App\Entity\Etat','choice_label' => 'libelle' ))
            ->add('typeInstrument', EntityType::class, array('class' => 'App\Entity\TypeInstrument','choice_label' => 'libelle' ))
            ->add('enregistrer', SubmitType::class, array('label' => 'Nouvel Instrument'))
        ;
    }

    public function getParent(){
        return InstrumentType::class;
      }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Instrument::class,
        ]);
    }
}
