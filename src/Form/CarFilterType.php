<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Car;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvents;


class CarFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('brand', EntityType::class, [
            'class' => Brand::class,
            'choice_label' => 'name',
            'placeholder' => 'Marques',
            'mapped' => false,
        ])

        ->add('car', ChoiceType::class, [
            'placeholder' => 'Modèles',
            'required' => false,
        
        ])

        ->add('Rechercher', SubmitType::class)
    ;

    $formModifier = function(FormInterface $form, Brand $brand = null) {
        $cars = null === $brand ? [] : $brand->getCar();

        $form->add('car', EntityType::class, [
            'class' => Car::class,
            'choices' => $cars,
            'choice_label' => 'model',
            'placeholder' => 'Modèles',
            // 'attr' => ['class' => 'custom-select']
        ]);
    };

        // $builder->addEventListener(
        //     FormEvents::PRE_SET_DATA,
        //     function (FormEvent $event) use ($formModifier){
        //         $data = $event->getData();
        //         // dd($data);
        //         $formModifier($event->getForm(), $data->getCar());
        //     }
        // );

        $builder->get('brand')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier){
                $brands = $event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $brands);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
