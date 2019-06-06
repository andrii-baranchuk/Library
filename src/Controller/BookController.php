<?php


namespace App\Controller;


use App\Entity\Book;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BookController extends AbstractController
{
    public function homepage(BookRepository $repository)
    {
        $books = $repository->findAll();

        return $this->render('home.html.twig', [
            'books' => $books]);
    }


}