<?php
namespace App\Form;

use App\Entity\Report;
use App\Entity\User;
use App\Entity\Place;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReportAddType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nazwa',
                'attr' => [
                    'placeholder' => 'Wpisz nazwę'
                ]
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'name',
                'label' => 'Użytkownik',
                'placeholder' => 'Wybierz użytkownika'
            ])
            ->add('place', EntityType::class, [
                'class' => Place::class,
                'choice_label' => 'name',
                'label' => 'Lokal',
                'placeholder' => 'Wybierz lokal'
            ])
            ->add('exportDateTime', DateTimeType::class, [
                'widget' => 'single_text',
                'label' => 'Data eksportu',
                'attr' => [
                    'class' => '',
                    'data-datetimepicker' => '',
                    'placeholder' => 'Kliknij aby wybrać datę'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Report::class,
            'csrf_protection' => false
        ]);
    }
}