<?php

namespace AppBundle\Form;

use AppBundle\Entity\SubFamily;
use AppBundle\Repository\SubFamilyRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
//            ->add('subFamily', EntityType::class, [
//                'placeholder' => 'Choose a Sub Family',
//                'class' => SubFamily::class,
//                'query_builder' => function(SubFamilyRepository $repo) {
//                    return $repo->createAlphabeticalQueryBuilder();
//                }
//            ])
            ->add('full_name')
            ->add('description')
            ->add('work_description')
            ->add('my_role')
            ->add('challenge')
            ->add('weight')
            ->add('display_on_home_page', ChoiceType::class, [
                'choices' => [
                    'Yes' => true,
                    'No' => false,
                ]
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'Enabled' => true,
                    'Disabled' => false,
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Project'
        ]);
    }
}
