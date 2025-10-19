<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\Measurement;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeasurementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'label'  => 'Date',
            ])
            ->add('time', TimeType::class, [
                'widget' => 'single_text',
                'with_seconds' => false,
                'label'  => 'Time',
            ])
            ->add('temperatureC', NumberType::class, [
                'label' => 'Temperature (°C)',
                'scale' => 2,
                'attr'  => ['step' => '0.01'],
            ])
            ->add('windSpeed', NumberType::class, [
                'label' => 'Wind speed',
                'scale' => 2,
                'attr'  => ['step' => '0.01'],
            ])
            ->add('humidity', IntegerType::class, [
                'label' => 'Humidity (%)',
                'attr'  => ['min' => 0, 'max' => 100],
            ])
            ->add('pressure', NumberType::class, [
                'label' => 'Pressure (hPa)',
                'scale' => 1,
                'attr'  => ['step' => '0.1'],
            ])
            ->add('precipitation', NumberType::class, [
                'label' => 'Precipitation (mm)',
                'scale' => 2,
                'attr'  => ['step' => '0.01'],
            ])
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'label' => 'Location',
                'placeholder' => 'Choose location',
                'choice_label' => fn (Location $l) => sprintf('%s, %s', $l->getCity(), $l->getCountry()),
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Measurement::class,
            'validation_groups' => null, // jeśli w kontrolerze chcesz używać 'create'/'edit'
        ]);
    }
}
