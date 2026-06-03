<?php

namespace App\Form;

use App\Entity\Campagne;
// use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType ;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CampagneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('id')
            ->add('titre',TextType::class,[
                'attr'=>['class' => 'w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-sm text-gray-900" placeholder="Ex: Jean Dupont']
            ])
            ->add('contenu',TextType::class,[
                'attr' =>['class' => 'w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-sm text-gray-900" placeholder="Ex: Jean Dupont']
            ])
            ->add('objectif',TextType::class ,[
                'attr' =>['class' => 'w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-sm text-gray-900" placeholder="Ex: Jean Dupont']
            ])
            ->add('nom',TextType::class,[
                'attr' => ['class'=>'w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 text-sm text-gray-900" placeholder="Ex: Jean Dupont']
            ])
            // ->add('cree_a', null, [
                // 'widget' => 'single_text',
            // ])
            // ->add('mise_a_jour', null, [
                // 'widget' => 'single_text',
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Campagne::class,
        ]);
    }
}
