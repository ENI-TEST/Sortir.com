<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\Sorties;
use App\Entity\Villes;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreationSortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de la sortie :',
            ])
            ->add('date_debut', DateTimeType::class, [
                'label' => 'Date et heure de la sortie :',
                'widget' => 'single_text',
                'html5' => true
            ])
            ->add('date_cloture', DateTimeType::class, [
                'label' => 'Date limite d\'inscription :',
                'widget' => 'single_text',
                'html5' => true
            ])
            ->add('nb_inscriptions_max', IntegerType::class, [
                'label' => 'Nombre de places :',
            ])
            ->add('duree', TextType::class, [
                'label' => 'Durée :',
            ])
            ->add('description_infos', TextareaType::class, [
                'label' => 'Description et infos :',
            ])
            #->add('etat_sortie')
            #->add('url_photo')
            /*->add('organisateur', IntegerType::class, [
                'attr' => ['readonly' => true,
                ]])*/
            ->add('campus', EntityType::class, [
                'class' => Campus::class,
                'choice_label' => 'nom_campus',
                'attr' => ['readonly' => true,
            ]])
            /*->add('ville', EntityType::class, [
                'class' => Villes::class,
                'choice_label' => 'nom_ville',
                'label_attr' => [
                    'class' => 'labelForm',
                    'mapped' => 'false',
            ]])*/
            #->add('etat')
            ->add('lieu', TextType::class, [
                'label' => 'Lieu :',
            ])
            /*->add('Rue', TextType::class, [
                'attr' => ['readonly' => true,
                ]
            ])
            ->add('code_postal', TextType::class, [
                'attr' => ['readonly' => true,
                ]
            ])
            ->add('latitude', FloatType::class, [
                'attr' => ['readonly' => true,
                ]
            ])
            ->add('longitude', FloatType::class, [
                'attr' => ['readonly' => true,
                ]
            ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sorties::class,
        ]);
    }
}
