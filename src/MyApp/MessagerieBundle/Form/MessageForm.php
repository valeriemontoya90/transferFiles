<?php

namespace MyApp\MessagerieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use MyApp\MessagerieBundle\Entity\Fichier;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MessageForm extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add("destinataire", 'text', array('required' => true))
            ->add("objet", 'text', array('required' => true))
            ->add("motDePasse", 'text', array('required' => false))
            ->add("file", "file")
            //->add('file', new FichierForm())
            //->add('file', 'file', array(
                //'data_class' => 'MyApp\MessagerieBundle\Entity\Fichier',))
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