<?php

namespace MyApp\MessagerieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConnexionForm extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add("mail", 'text', array('required' => true))
            ->add("motDePasse", 'text', array('required' => true))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'MyApp\MessagerieBundle\Entity\User',
        ));
    }

    public function getName() {
        return "connexion";
    }

}