<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use App\Repository\ReservationRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('domaine', ChoiceType::class,[
                'choices' =>[
                    '' =>[
                        'Aucun' =>'Aucun',
                        'Arts du spectacle vivant' =>'Arts du spectacle vivant',
                        'Arts de l’espace' =>'Arts de l’espace',
                        'Arts du visuel' =>'Arts du visuel',
                        'Arts du quotidien' =>'Arts du quotidien',
                        'Arts du son' =>'Arts du son',
                        'Arts du langage' =>'Arts de l’espaceArts du langage',

                    ],
                ], 'disabled'=>true
            ])

            ->add('nomformation',TextType::class,['label'=>'Nom de formation ','disabled'=>true])
          //   ->add('datedebut',TextType::class,['label'=>'Date debut ','disabled'=>true])
          //  ->add('datefin',TextType::class,['label'=>'Date fin ','disabled'=>true])
            ->add('description',TextareaType::class,['label'=>'Description ', 'disabled'=>true])
            ->add('prix',TextType::class,['label'=>'Prix inscription' , 'disabled'=>true])
            //->add('Enregistrer',SubmitType::class)
            ->add('Annuler',ResetType::class, ['disabled'=>true])
            // ->add('Modifier',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,]);
    }
}
