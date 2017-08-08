<?php

namespace AppBundle\Form;

use AppBundle\Entity\Solution;
use AppBundle\Manager\FileStorageManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    /**
     * @var FileStorageManager
     */
    protected $fileStorageManager;

    const CURRENT_CONTEXT = 'project';

    /**
     * SolutionType constructor.
     * @param FileStorageManager $fileStorageManager
     */
    public function __construct(FileStorageManager $fileStorageManager)
    {
        $this->fileStorageManager = $fileStorageManager;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('fullName')
            ->add('description')
            ->add('workDescription')
            ->add('myRole')
            ->add('challenge')
            ->add('weight')
            ->add('imageLogo', null, [
                'choices' => $this->fileStorageManager->getRepository()->findByContext(self::CURRENT_CONTEXT),
            ])
            ->add('imageTemplate', null, [
                'choices' => $this->fileStorageManager->getRepository()->findByContext(self::CURRENT_CONTEXT),
            ])
            ->add('displayOnHome', ChoiceType::class, [
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
            ->add('solutions', EntityType::class, [
                'class' => Solution::class,
                'multiple' => true,
                'attr' => array('class' => 'selectpicker'),
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Project'
        ]);
    }
}
