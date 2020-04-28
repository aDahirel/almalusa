<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Wording;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Image;


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
            ->add('content', CKEditorType::class, [
                'required' => false,
                'config' => [
                    'uiColor' => "#e2e2e2",
                    'toolbar' => 'standard'
                ]
            ])
            ->add('imageFile', FileType::class, [
                'required' => false,
                'constraints' => [
                    new Image([
                        'maxSize' => '4M',
                        'mimeTypes' => 'image/*',
                        'mimeTypesMessage' => 'Le fichier ne correspond pas à une photo.'
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

