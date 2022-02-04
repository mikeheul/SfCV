<?php

namespace App\Form;

use App\Entity\Personne;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PersonneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('dateNaissance', DateType::class, [
                'widget' => 'single_text',
                'label' => 'Date de naissance'
            ])
            ->add('intituleCV', TextType::class, [
                'label' => 'Intitulé du CV'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse email'
            ])
            ->add('telephone', TextType::class, [
                'label' => 'Téléphone du candidat'
            ])
            ->add('adresse', TextType::class, [])
            ->add('cp', TextType::class, [
                'label' => 'Code postal'
            ])
            ->add('ville', TextType::class, [])
            ->add('experiences', CollectionType::class, [
                'entry_type' => ExperienceType::class,
                'entry_options' => [
                    'label' => false,
                ],
                'by_reference' => false,
                'allow_add' => true,
                'allow_delete' => true
            ])
            ->add('valider', SubmitType::class, [
                'attr' => ['class' => 'btn btn-success']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personne::class,
        ]);
    }
}
