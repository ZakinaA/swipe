<?php

namespace App\Form;

use App\Entity\Cours;
use App\Entity\TypeCours;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class ModifierCoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', TextType::class)
            ->add('ageMini', TextType::class)
            ->add('ageMaxi', TextType::class)
            ->add('nbPlaces', TextType::class)
            ->add('dateCours', TextType::class)
            ->add('Heure_Debut', TextType::class)
            ->add('Heure_Fin', TextType::class)
            ->add('professeur', EntityType::class, array('class' => 'App\Entity\Professeur','choice_label' => 'nom' ))
            ->add('typeCours', EntityType::class, array('class' => 'App\Entity\TypeCours','choice_label' => 'libelle' ))
            ->add('instrument', EntityType::class, array('class' => 'App\Entity\TypeInstrument','choice_label' => 'libelle' ))

            ->add('enregistrer', SubmitType::class, array('label' => 'Enregistrer'));
    }
 
    public function getParent(){
      return AjouterCoursType::class;
    }
 
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}

?>