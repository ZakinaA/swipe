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
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class AjouterCoursType extends AbstractType
{
    private $authorizationChecker;

    public function __construct(AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($this->authorizationChecker->isGranted('ROLE_PROFESSEUR')) {
            $builder
                ->add('professeur', EntityType::class, array(
                    'class' => 'App\Entity\Professeur',
                    'choice_label' => 'nom',
                    'query_builder' => function (EntityRepository $er) use ($options) {
                        return $er->createQueryBuilder('e')
                            ->where('e.id = :user_id')
                            ->setParameter('user_id', $options['prof_id']);
                    },
                ));
        } else {
            $builder
                ->add('professeur', EntityType::class, array('class' => 'App\Entity\Professeur', 'choice_label' => 'nom'));
        }
        $builder
            ->add('libelle', TextType::class)
            ->add('ageMini', TextType::class)
            ->add('ageMaxi', TextType::class)
            ->add('nbPlaces', TextType::class)
            ->add('dateCours', TextType::class)
            ->add('Heure_Debut', TextType::class)
            ->add('Heure_Fin', TextType::class)
            ->add('prix', TextType::class)
            ->add('typeCours', EntityType::class, array('class' => 'App\Entity\TypeCours', 'choice_label' => 'libelle'))
            ->add('instrument', EntityType::class, array('class' => 'App\Entity\TypeInstrument', 'choice_label' => 'libelle'))

            ->add('enregistrer', SubmitType::class, array('label' => 'Enregistrer'));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired('prof_id');
        $resolver->setDefaults([
            'data_class' => Cours::class,
        ]);
    }
}
