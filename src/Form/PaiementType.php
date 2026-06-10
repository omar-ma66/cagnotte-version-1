<?php

namespace App\Form;

 use App\Entity\Paiement;
 use App\Entity\Participants;
 use App\Entity\Campagne;

use App\Repository\CampagneRepository;

 use Symfony\Bridge\Doctrine\Form\Type\EntityType;

 use Symfony\Component\OptionsResolver\OptionsResolver;



use App\Form\ParticipantsType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

class PaiementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
      
        $inputStyle = 'w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:border-teal-500 focus:ring-1 focus:ring-teal-500 transition-colors';

        $builder
            // 1. Champ Montant stylisé
            ->add('montant', NumberType::class, [
                'label' => ' votre participation (€)',
                'label_attr' => ['class' => 'block text-sm font-semibold text-gray-700 mb-1'],
                'attr' => [
                    'class' => $inputStyle,
                    'placeholder' => 'Ex: 20'
                ]
            ])
            
            // 2. Champ Date de Création
            // ->add('cree_a', DateTimeType::class, [
            //      'widget' => 'single_text',
            //     'label' => 'Date de création',
            //     'label_attr' => ['class' => 'block text-sm font-semibold text-gray-700 mb-1'],
            //     'attr' => ['class' => $inputStyle]
            // ])
            
            // 3. Champ Date de Mise à jour
            // ->add('mise_a_jour', DateTimeType::class, [
            //      'widget' => 'single_text',
            //     'label' => 'Dernière mise à jour',
            //     'label_attr' => ['class' => 'block text-sm font-semibold text-gray-700 mb-1'],
            //     'attr' => ['class' => $inputStyle]
            // ])
            
            // 4. Sous-formulaire Participant (Imbriqué)
            ->add('participant', ParticipantsType::class, [
                'label' => false,
                'row_attr' => ['class' => 'mt-6 border-t border-gray-100 pt-4']
            ])
       
            // ->add('campagne', EntityType::class, [
            //     'class' => Campagne::class,
            //     'choice_label' => 'titre', // Affiche le titre de la campagne dans la liste déroulante
            //     'label' => 'Sélectionnez la cagnotte',
            //     'label_attr' => ['class' => 'block text-sm font-semibold text-gray-700 mb-1'],
            //     'attr' => ['class' => $inputStyle],
            //     'placeholder' => 'Choisir une campagne...', // Option vide par défaut
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Paiement::class,
        ]);
    }
}