<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\Lieu;
use App\Entity\Sortie;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreationSortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('date_debut', DateTimeType::class, [
                'widget' => 'single_text',
                'html5' => true
            ])
            ->add('date_cloture', DateTimeType::class, [
                'widget' => 'single_text',
                'html5' => true
            ])
            ->add('nb_inscriptions_max')
            ->add('duree')
            ->add('description_infos')
            #->add('etat_sortie')
            #->add('url_photo')
            #->add('organisateur')
            ->add('campus', EntityType::class, [
                'class' => Campus::class,
                'choice_label' => 'nomCampus',
                'attr' => ['readonly' => true,
            ]])
            /*->add('ville', EntityType::class, [
                'class' => Ville::class,
                'choice_label' => 'nom_ville',
                'label_attr' => [
                    'class' => 'labelForm',
                    'mapped' => 'false',
            ]])*/
            #->add('etat')
            ->add('lieu',EntityType::class, [
                'class' => Lieu::class,
                'label' => 'Lieu :',
                'choice_label' => 'nomLieu'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}
