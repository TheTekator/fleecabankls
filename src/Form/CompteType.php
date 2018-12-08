<?php

namespace App\Form;

use App\Entity\Compte;
use App\Entity\GenreCompte;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('genreCompte', EntityType::class,
                array('class' => GenreCompte::class,
                    'choice_label' => 'name',
                    'expanded' => false,
                    'multiple' => false))
            ->add('number', TextType::class)
            ->add('fraisOuverture', IntegerType::class)
            ->add('fraisTenue', IntegerType::class)
            ->add('open', CheckboxType::class, array('required' => false))
            ->add('dateOuverture', DateType::class, array('widget' => 'single_text'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Compte::class,
        ]);
    }
}
