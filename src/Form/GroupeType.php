<?php


namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class GroupeType extends AbstractType {

    /**
     * Chaque champ devant figurer dans l'interface web est défini ici.
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('nom', TextType::class, array(
                    'label' => 'Nom',
                    'attr' => array('style' => 'width: 50px'),
                    'max_length' => 15))
            ->add('submit', SubmitType::class, array('label' => 'Cree')

            );
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Fonction',
        ));
    }
}