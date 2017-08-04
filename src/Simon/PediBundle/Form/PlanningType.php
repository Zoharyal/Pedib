<?php

namespace Simon\PediBundle\Form;

use Simon\PediBundle\Entity\Planning;
use Simon\UserBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class PlanningType extends AbstractType
{
    
   public function buildForm(FormBuilderInterface $builder, array $options) 
   {
       $builder
           ->add('planningday', ChoiceType::class, array( 'label' => 'Sélectionnez un jour',
              'choices' => array('Lundi' => 1
                                 , 'Mardi' => 2
                                 , 'Mercredi' => 3
                                 , 'Jeudi' => 4
                                 , 'Vendredi' => 5 ),
                                  'attr' => array( 'id' => ' allo')))
            ->add('planningcontent', TextType::class, array( 'label' => 'Description'))
            ->add('S\'inscrire au planning', SubmitType::class)
           ;
   }
    
   public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Simon\UserBundle\Entity\User'
        ));
    }

}