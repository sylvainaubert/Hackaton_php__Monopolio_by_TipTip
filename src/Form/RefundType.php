<?php

namespace App\Form;

use App\Entity\Refund;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RefundType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('benefit')
            ->add('regulatedPrice')
            ->add('basicRefund')
            ->add('refundRate')
            ->add('RefundRateTipTip')
            ->add('secuSupported')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Refund::class,
        ]);
    }
}
