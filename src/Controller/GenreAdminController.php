<?php

declare(strict_types=1);

/*
 * This file is part of the library.
 */

namespace App\Controller;

use App\Entity\Genre;
use App\Form\GenreFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class GenreAdminController extends AbstractController
{
    public function newgenre(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(GenreFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $genre = new Genre();
            $genre->setName($data['name']);

            $em->persist($genre);
            $em->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('new_genre.html.twig', ['genreForm' => $form->createView()]);
    }
}
