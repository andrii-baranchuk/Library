<?php


namespace App\Controller;


use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Genre;
use App\Form\ArticleFormType;
use App\Form\BookFormType;
use App\Repository\ArticleRepository;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Validation\Article;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class BookAdminController extends AbstractController
{
    public function new(EntityManagerInterface $em, Request $request)
    {
        $form = $this->createForm(BookFormType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $book = $form->getData();
            $em->persist($book);
            $em->flush();

            //return $this->redirectToRoute('index');

        }
        return $this->render('newbook.html.twig',[
            'bookForm' => $form->createView()
        ]);

    }

    public function list(BookRepository $bookRepository)
    {
        $books = $bookRepository->findAll();

        return $this->render('list.html.twig', [
            'books' => $books,
        ]);
    }

    public function edit(Book $book, Request $request, EntityManagerInterface $em)
    {
        $form = $this->createForm(BookFormType::class, $book);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $book = $form->getData();
            $em->persist($book);
            $em->flush();

            return $this->redirectToRoute('edit',['id' => $book->getId()]);

        }
        return $this->render('editbook.html.twig',[
            'bookForm' => $form->createView()
        ]);
    }
}