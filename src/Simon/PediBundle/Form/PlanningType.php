<?php

namespace Simon\PediBundle\Form;

use Simon\PediBundle\Entity\Planning;
use Simon\UserBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PlanningType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('planningcontent', TextType::class, array( 'label' => 'Description'));
        $builder->add('S\'inscrire au planning', SubmitType::class)
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $events){
            
        }); 
            
        
    }
}