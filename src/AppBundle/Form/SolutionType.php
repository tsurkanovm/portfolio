<?php

namespace AppBundle\Form;

use AppBundle\Manager\FileStorageManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SolutionType extends AbstractType
{
    /**
     * @var FileStorageManager
     */
    protected $fileStorageManager;

    const CURRENT_CONTEXT = 'solution';

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
            ->add('logo', null, [
                'choices' => $this->fileStorageManager->getRepository()->findByContext(self::CURRENT_CONTEXT),
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Solution'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'solutionForm';
    }
}
