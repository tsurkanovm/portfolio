<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SolutionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('logo', null, [
//                @todo create manager and place there this functionality
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('fl')
                        ->where('fl.context = :context')
                        ->setParameter('context', 'solution');
                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Solution'
        ]);
    }

    public function getName()
    {
        return 'solutionForm';
    }
}
