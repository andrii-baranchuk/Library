<?php


namespace App\Controller;


use App\Entity\Author;
use App\Entity\Book;
use App\Entity\Genre;
use App\Form\BookFormType;
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

}