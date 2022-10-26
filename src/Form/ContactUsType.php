<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;


class ContactUsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', Texttype::Class, [
                'attr' => [
                    'placeholder' => 'Email',
                    'require' => TRUE]
            ])
            ->add('name', Texttype::Class, [
                'attr' => [
                    'placeholder' => 'Votre Nom',
                    'require' => TRUE]
            ])
            ->add('phone', Texttype::Class, [
                'attr' => [
                    'placeholder' => 'Telephone',
                    'require' => TRUE
                    ]
            ])
            ->add('object', Texttype::Class, [
                'attr' => [
                    'placeholder' => 'Object de votre message',
                    'require' => TRUE]
            ])
            ->add('message', TextareaType::Class, [
                'attr' => [
                    'placeholder' => 'Veuillez saisir votre message ici', 'class' => 'ckeditor']
            ])
            ->add('message', CKEditorType::class, array(
                'config' => array(
                    'uiColor' => '#ffffff',
                    //...
                ),
            ))
            ->add('Envoyer', Submittype::Class, [
                'attr' => [
                    'class' => 'text-center']])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,


        ]);
    }
}
