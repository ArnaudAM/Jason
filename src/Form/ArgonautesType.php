<?php

namespace App\Form;

use App\Entity\Argonautes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ArgonautesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'toto',
                    'placeholder' => 'Le nom du gars',
                ],
            ])
            ->add('softskill', TextType::class, [
                'attr' => [
                    'placeholder' => 'Il a du skill le gars',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Argonautes::class,
        ]);
    }
}
