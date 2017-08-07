<?php

namespace Simon\UserBundle\Form\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array('label' => 'Prénom '))
                ->add('lastname', TextType::class,  array('label' => 'Nom '))
                ->add('phone', TextType::class, array('label' => 'Numéro de télephone', 'attr' => array('placeholder' => '0X XX XX XX XX')))
                ->add('address', TextType::class, array('label' => 'Adresse', 'attr' => array('placeholder' => "N° / Libellé de la voie")))
                ->add('city', TextType::class, array('label' => 'Ville'))
                ->add('postCode', TextType::class, array('label' => 'Code Postal'))
                ->add('avatarFile', Filetype::class, array( 'label' => "Avatar"))
            ;
                
    }
    
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }
    
    public function getBlockPrefix()
    {
        return 'simon_user_registration';
    }
}
