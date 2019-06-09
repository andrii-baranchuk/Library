<?php

declare(strict_types=1);

/*
 * This file is part of the library.
 */

namespace App\Controller;

use App\Entity\Genre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GenreController extends AbstractController
{
    public function showGenre(): Response
    {
        $em = $this->getDoctrine()->getRepository(Genre::class);
        $genres = $em->findAll();

        return $this->render('genre/_header_genres.html.twig', ['genres' => $genres]);
    }

    public function showBooks($slug): Response
    {
        $em = $this->getDoctrine()->getRepository(Genre::class);

        $genreBooks = $em->findOneBy(['slug' => $slug])->getBooks();

        return $this->render('genre/genre_books.html.twig', ['genreBooks' => $genreBooks]);
    }
}
