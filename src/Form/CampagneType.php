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
                'attr'=>['class' => 'form-control']
            ])
            ->add('contenu',TextType::class,[
                'attr' =>['class' => 'form-control']
            ])
            ->add('objectif',TextType::class ,[
                'attr' =>['class' => 'form-control']
            ])
            ->add('nom',TextType::class,[
                'attr' => ['class'=>'form-control']
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
