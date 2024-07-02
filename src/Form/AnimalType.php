<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Owner;
use App\Entity\Veterinarian;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('race')
            ->add('dateBirth', null, [
                'widget' => 'single_text',
            ])
            ->add('gender')
            ->add('color')
            ->add('weight')
            ->add('id_veterinarian', EntityType::class, [
                'class' => Veterinarian::class,
                'choice_label' => 'id',
            ])
            ->add('id_owner', EntityType::class, [
                'class' => Owner::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
