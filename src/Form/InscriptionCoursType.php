<?php

namespace App\Form;

use App\Entity\Inscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class InscriptionCoursType extends AbstractType
{
    private $authorizationChecker;

    public function __construct(AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($this->authorizationChecker->isGranted('ROLE_ELEVE')) {
            $builder
                ->add('nombre_de_paiements')
                ->add('eleve', EntityType::class, array(
                    'class' => 'App\Entity\Eleve',
                    'choice_label' => 'nom',
                    'query_builder' => function (EntityRepository $er) use ($options) {
                        return $er->createQueryBuilder('e')
                            ->where('e.id = :user_id')
                            ->setParameter('user_id', $options['eleve_id']);
                    },
                ))
                ->add('cours', EntityType::class, array('class' => 'App\Entity\Cours', 'choice_label' => 'libelle'));
        } else {
            $builder
                ->add('nombre_de_paiements')
                ->add('eleve', EntityType::class, array('class' => 'App\Entity\Eleve', 'choice_label' => 'nom'))
                ->add('cours', EntityType::class, array('class' => 'App\Entity\Cours', 'choice_label' => 'libelle'));
        }
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('eleve_id');
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
