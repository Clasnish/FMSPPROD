<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class,[
                'label' => false
            ])
            ->add('password', PasswordType::class, [
                'label' => false
            ])
            ->add('FirstName', TextType::class, [
                'label' => false
            ])
            ->add('LastName', TextType::class,[
                'label' => false
            ])
            ->add('Birthday', DateType::class, [
                    'label' => false,
                    'widget' => 'single_text',
                    'html5' => true,
                    'attr' => ['class' => 'js-datepicker'],
                    'format' => 'yyyy-MM-dd',
                    'input_format' => 'y-m-d' // ajouté en 4.3
            ])
            ->add('confirmpassword', PasswordType::class, [
                'label' => false
            ])
            ->add('phone', TextType::class, [
                'label' => false
            ])
            ->add('Inscription', Submittype::Class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
