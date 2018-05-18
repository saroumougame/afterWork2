<?php
// src/AppBundle/Form/RegistrationType.php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault(array('data_class' => 'App\Entity\User'));
    }


    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_user';
    }


}