<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Wording;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\NotBlank;


class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('wordings', EntityType::class, [
                'class' => Wording::class,
                'choice_label' => 'title',
                'multiple' => true
            ])
            ->add('content')
            ->add('imageFile', FileType::class, [
                'required' => false,
                'constraints' => [
                    new Image([
                        'maxSize' => '4M',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}

/*
 *
                'constraints' => [
                    new File([
                        'maxSize' => '10k',
                        'mimeTypes' => [
                            "image/jpeg", "image/png", "image/jpg", "image/gif",
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image document',
                    ])
                ]
 */
