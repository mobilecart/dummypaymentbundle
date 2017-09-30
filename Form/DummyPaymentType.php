<?php

namespace MobileCart\DummyPaymentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

/**
 * Class DummyPaymentType
 * @package MobileCart\DummyPaymentBundle\Form
 */
class DummyPaymentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $months = [
            '1' => '01 - January',
            '2' => '02 - February',
            '3' => '03 - March',
            '4' => '04 - April',
            '5' => '05 - May',
            '6' => '06 - June',
            '7' => '07 - July',
            '8' => '08 - August',
            '9' => '09 - September',
            '10' => '10 - October',
            '11' => '11 - November',
            '12' => '12 - December',
        ];

        $years = [];
        $thisYear = (int) date('Y');
        $maxYear = $thisYear + 7;
        for ($year = $thisYear; $year <= $maxYear; $year++) {
            $years[$year] = $year;
        }

        $builder->add('number', TextType::class, [
                'label' => 'Credit Card Number',
                'required' => 1,
                'constraints' => [
                    new NotBlank(),
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('expiryMonth', ChoiceType::class, [
                'label' => 'Expiration Month',
                'required' => 1,
                'choices' => $months,
                'constraints' => [
                    new NotBlank(),
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('expiryYear', ChoiceType::class, [
                'label' => 'Expiration Year',
                'required' => 1,
                'choices' => $years,
                'constraints' => [
                    new NotBlank(),
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('cvv', TextType::class, [
                'label' => 'CVV',
                'required' => 1,
                'constraints' => [
                    new NotBlank(),
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
        ;
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'dummy';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
        ]);
    }
}
