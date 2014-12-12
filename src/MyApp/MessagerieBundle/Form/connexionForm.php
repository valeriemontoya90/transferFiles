<?php

namespace MyApp\MessagerieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConnexionForm extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add("objet", 'text', array('required' => true))
            ->add("contenu", 'text', array('required' => true))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'MyApp\MessagerieBundle\Entity\Message',
        ));
    }

    public function getName() {
        return "message";
    }
}