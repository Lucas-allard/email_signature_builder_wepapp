<?php

namespace App\Form;

use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class EmployeeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, [
                'label' => 'Email Mili-Atlas *',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer une adresse email',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre adresse email doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Email',
                ],
            ])
            ->add('secondEmail', TextType::class, [
                'label' => 'Email 1806 Patrimoine *',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer une adresse email',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre adresse email doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Email',
                ],
            ])
            ->add('thirdEmail', TextType::class, [
                'label' => 'Email 1806 Mili-Invest *',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer une adresse email',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre adresse email doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Email',
                ],
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom *',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir votre prénom',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre prénom doit comporter au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Prénom',
                ],
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom *',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir votre nom',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre nom doit comporter au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Nom',
                ],
            ])
            ->add('position', TextType::class, [
                'label' => 'Rôle dans l\'entreprise *',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir votre rôle dans l\'entreprise',
                    ]),
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre rôle doit comporter au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Rôle dans l\'entreprise',
                ],
            ])
            ->add('picture', FileType::class, [
                'label' => 'Photo de la signature *',
                'required' => true,
                'mapped' => false,
                'data_class' => null,
                'help' => 'Vous devez sélectionner une image ayant une mesure de 220 par 294 pixels',
                'row_attr' => ['placeholder' => 'Sélectionnez un fichier'],
            ])
            ->add('phoneNumber', TextType::class, [
                'required' => false,
                'label' => 'Numéro de téléphone',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir votre numéro de téléphone',
                    ]),
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Votre numéro de téléphone doit comporter au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 10,
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Numéro de téléphone',
                ],
            ])
            ->add('facebookUrl', TextType::class, [
                'required' => false,
                'label' => 'Lien Facebook',
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre lien doit comporter au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Lien Facebook',
                ],
            ])
            ->add('twitterUrl', TextType::class, [
                'required' => false,
                'label' => 'Lien Twitter',
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre lien doit comporter au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Lien Twitter',
                ],
            ])
            ->add('linkedinUrl', TextType::class, [
                'required' => false,
                'label' => 'Lien Linkedin',
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre lien doit comporter au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Lien Linkedin',
                ],
            ])
            ->add('instagramUrl', TextType::class, [
                'required' => false,
                'label' => 'Lien Instagram',
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'minMessage' => 'Votre lien doit comporter au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Lien Instagram',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'S\'inscrire',
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ]);;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
        ]);
    }
}
