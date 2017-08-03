<?php

namespace AppBundle\Form;

use AppBundle\Manager\FileStorageManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class FileStorageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //@todo - add needed fields and remove comments
        $builder
            ->add('name')
            ->add('uploadedFile', VichImageType::class, [
                'required' => true,
                'allow_delete' => false,
                'label' => 'Solution image',
                'download_uri' => false,
//                'download_label' => 'Down',
                'image_uri' => true,
//                'imagine_pattern' => '...',
            ])
            ->add('context', ChoiceType::class, [
                'choices' => FileStorageManager::getAllowedContext()
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\FileStorage'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'fileStorageForm';
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_filestorage';
    }
}
