<?php

namespace App\Form;

use App\Entity\Campagne;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CampagneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $inputClasses = 'peer w-full border-b-2 border-gray-300 py-2 pt-4 focus:outline-none focus:border-teal-500 transition-colors placeholder-transparent';
        $labelClasses = 'absolute left-0 top-0 text-sm text-gray-500 transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-3 peer-focus:top-0 peer-focus:text-sm peer-focus:text-teal-500';

        $builder
            ->add('nom', TextType::class, [
                'label' => 'Votre Nom',
                'label_attr' => ['class' => $labelClasses],
                'attr' => ['class' => $inputClasses, 'placeholder' => 'Votre Nom'],
            ])
            ->add('titre', TextType::class, [
                'label' => 'Donnez un titre à votre campagne',
                'label_attr' => ['class' => $labelClasses],
                'attr' => ['class' => $inputClasses, 'placeholder' => 'Titre de votre campagne'],
            ])
            ->add('objectif', NumberType::class, [
                'label' => 'Votre objectif en euros',
                'label_attr' => ['class' => $labelClasses],
                'attr' => ['class' => $inputClasses, 'placeholder' => 'Votre objectif en euros'],
            ])
            ->add('contenu', TextareaType::class, [
                'label' => 'Description de votre campagne',
                'label_attr' => ['class' => 'block text-sm font-medium text-gray-600 mb-2'],
                'attr' => [
                    'placeholder' => 'Décrivez à vos amis pourquoi vous faites une campagne...'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Campagne::class,
        ]);
    }
}