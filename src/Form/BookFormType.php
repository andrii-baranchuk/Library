<?php

declare(strict_types=1);

/*
 * This file is part of the library.
 */

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Genre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $book = $options['data'] ?? null;
        $isEdit = $book && $book->getId();
        $builder
        ->add('name')
        ->add('status', ChoiceType::class, ['choices' => [
            'In Progress' => null,
            'Finished' => true,
            'Will read' => false,],
            ])
        ->add('description')
        ->add('year')
        ->add('author', EntityType::class, [
            'class' => Author::class,'choice_label' => function (Author $author) {
                return \sprintf('%s',$author->getName());
            },
            'placeholder' => 'Choose an author',
            ])
        ->add('genre', EntityType::class, [
            'class' => Genre::class,'choice_label' => function (Genre $genre) {
                return \sprintf('%s',$genre->getName());
            },
            'placeholder' => 'Choose a genre',
        ])

        ->add('imageFile', FileType::class, [
            'mapped' => false, 'required' =>false,
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' =>Book::class,
        ]);
    }
}
