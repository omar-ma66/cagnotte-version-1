<?php

namespace App\Form;

use App\Entity\Campagne;
use App\Entity\Participants;
// use Doctrine\DBAL\Types\TextType;


use Symfony\Component\Form\Extension\Core\Type\TextType; //  BON IMPORT
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipantsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $inputStyle = 'w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-colors';
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Votre Nom / Pseudo',
                'label_attr' => ['class' => 'block text-sm font-semibold text-gray-700 mb-1'],
                'attr' => ['class' => $inputStyle, 'placeholder' => 'Ex: Jean Dupont']
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse Email',
                'label_attr' => ['class' => 'block text-sm font-semibold text-gray-700 mb-1'],
                'attr' => ['class' => $inputStyle, 'placeholder' => 'jean.dupont@example.com']
            ])

          //  ->add('nom')
           // ->add('email')
          
            // ->add('cree_a', null, [
            //     'widget' => 'single_text',
            // ])
            // ->add('mise_a_jour', null, [
            //     'widget' => 'single_text',
            // ])
                
            // ->add('campagne', EntityType::class, [
            //     'class' => Campagne::class,
            //     'choice_label' => 'titre',
            // ])
                
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Participants::class,
        ]);
    }
}
