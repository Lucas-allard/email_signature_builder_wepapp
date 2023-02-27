<?php

namespace App\Form;

use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class EmployeeFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstEmail', TextType::class, [
                'label' => 'Email Mili-Atlas',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Email Mili-Atlas',
                ],
            ])
            ->add('secondEmail', TextType::class, [
                'label' => 'Email Mili-Invest',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Email Mili-Invest',
                ],
            ])
            ->add('thirdEmail', TextType::class, [
                'label' => 'Email 1806-Patrimoine',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Email 1806-Patrimoine',
                ],
            ])
//            ->add('fourEmail', TextType::class, [
//                'label' => 'Email 1806-Patrimoine',
//                'required' => false,
//                'attr' => [
//                    'placeholder' => 'Email 1806-Patrimoine',
//                ],
//            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom *',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Prénom',
                ],
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom *',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Nom',
                ],
            ])
            ->add('position', TextType::class, [
                'label' => 'Rôle dans l\'entreprise *',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Rôle dans l\'entreprise',
                ],
            ])
            ->add('picture', TextType::class, [
                'label' => 'Photo de l\'employé',
                'help' => 'Vous devez saisir une URL valide (photos hébergées sur un serveur externe)',
                'attr' => ['placeholder' => 'Sélectionnez un fichier'],
            ])
            ->add('phoneNumber', TextType::class, [
                'required' => true,
                'label' => 'Numéro de téléphone *',
                'constraints' => [
                    new Length([
                        'min' => 10,
                        'minMessage' => 'Votre numéro de téléphone doit comporter au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 14,
                    ]),
                ],
                'attr' => [
                    'placeholder' => 'Numéro de téléphone',
                ],
            ])
            ->add('linkedinUrl', TextType::class, [
                'required' => false,
                'label' => 'Lien Linkedin',
                'attr' => [
                    'placeholder' => 'Lien Linkedin',
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => $options['submit_label'],
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ]);


        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {

            // if the collaborator is new, we set the default value for the email fields

            $employee = $event->getData();
            $form = $event->getForm();

            if ($employee->getId() === null) {
                // if the collaborator is new, we set the default value for the email fields
                $form->add('firstEmail', TextType::class, [
                    'label' => 'Email Mili-Atlas',
                    'required' => false,
                    'data'=> '@mili-atlas.fr',
                    'empty_data' => '',
                    'attr' => [
                        'placeholder' => 'Email Mili-Atlas',
                    ],
                ])
                    ->add('secondEmail', TextType::class, [
                        'label' => 'Email Mili-Invest',
                        'required' => false,
                        'data'=> '@mili-invest.fr',
                        'empty_data' => '',
                        'attr' => [
                            'placeholder' => 'Email Mili-Invest',
                        ],
                    ])
                    ->add('thirdEmail', TextType::class, [
                        'label' => 'Email 1806-Patrimoine',
                        'data'=> '@1806-patrimoine.fr',
                        'empty_data' => '',
                        'required' => false,
                        'attr' => [
                            'placeholder' => 'Email 1806-Patrimoine',
                        ],
                    ]);
            }

        });
    }

    /**
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
            'submit_label' => 'Enregistrer',
        ]);

        $resolver->setAllowedTypes('submit_label', 'string');

    }
}
