<?php

namespace MyApp\MessagerieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ParrainerForm extends AbstractType {
	public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add("Destinataire", 'text', array('required' => true))
            ->add("Objet", 'text', array('required' => true))
            ->add("Corps", 'textarea', array('required' => true))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'MyApp\MessagerieBundle\Entity\Parrainage',
        ));
    }

    public function getName() {
        return "parrainage";
    }
}