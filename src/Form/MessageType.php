<?php
/**
 * Created by PhpStorm.
 * User: sridar
 * Date: 24/05/2018
 * Time: 17:42
 */




namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class MessageType extends AbstractType {

    /**
     * Chaque champ devant figurer dans l'interface web est défini ici.
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('message', TextType::class, array(
                'label' => 'Message',
                'attr' => array('style' => 'width: 50px'),
                'max_length' => 15))
            ->add('submit', SubmitType::class, array('label' => 'Envoyer')

            );
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Message',
        ));
    }
}