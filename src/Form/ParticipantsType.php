<?php

namespace App\Form;

use App\Entity\Campagne;
use App\Entity\Participants;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipantsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('email')
            /*
            ->add('cree_a', null, [
                'widget' => 'single_text',
            ])
            ->add('mise_a_jour', null, [
                'widget' => 'single_text',
            ])
                
            ->add('campagne', EntityType::class, [
                'class' => Campagne::class,
                'choice_label' => 'id',
            ])
                */
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Participants::class,
        ]);
    }
}
