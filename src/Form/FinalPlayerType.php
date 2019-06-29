<?php

namespace App\Form;

use App\Entity\Player;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FinalPlayerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'label_attr' => ['class' => 'col-md-12']
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'label_attr' => ['class' => 'col-md-12']
            ])
            ->add('email', TextType::class, [
                'label' => 'Email',
                'label_attr' => ['class' => 'col-md-12']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Player::class,
        ]);
    }
}
