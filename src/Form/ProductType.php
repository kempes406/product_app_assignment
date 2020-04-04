<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label'    => 'Product Name',
                'required' => true
            ])
            ->add('id', TextType::class, [
                'label'    => 'Product Id',
                'required' => true
            ])
            ->add('manager', TextType::class, [
                'label'    => 'Product Manager',
                'required' => false
            ])
            ->add('salesStartDate',  DateType::class, [
                'label'    => 'Sales start date',
                'required' => true
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success rounded-0',
                    'disabled' => false
                ],
                'label' => 'Add'
            ])
            ->add('reset', ResetType::class, [
                'attr' => [
                    'class' => 'btn btn-danger rounded-0',
                    'disabled' => false
                ],
                'label' => 'Reset'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
