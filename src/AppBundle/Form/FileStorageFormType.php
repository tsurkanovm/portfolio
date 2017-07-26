<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class FileStorageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('uploadedFile', VichImageType::class, [
                'required' => true,
                'allow_delete' => false,
//                'label' => 'Solution image',
                'download_uri' => false,
//                'download_label' => 'Down',
                'image_uri' => true,
//                'imagine_pattern' => '...',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\FileStorage'
        ]);
    }
}
