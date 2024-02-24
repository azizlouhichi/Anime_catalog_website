<?php

namespace App\Form;

use App\Entity\Anime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Category;


class AnimeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description',)
            ->add('nbSeason')
            ->add('nbEpisode')
            ->add('author')
            ->add('photo',FileType::class,['mapped'=>false,'required'=>false,'constraints'=>[new File(['maxSize'=>'5M', 'mimeTypes'=>['image/*']])]]
            )
            ->add('category',EntityType::class,[
                'class' => Category::class,

                'choice_label' => 'nom',

                'multiple' => false,
                'expanded' => false,

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Anime::class,
        ]);
    }
}
