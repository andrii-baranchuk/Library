<?php


namespace App\Controller;


use App\Entity\Author;
use App\Form\AuthorFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AuthorAdminController extends AbstractController
{
    public function newauthor(EntityManagerInterface $em,Request $request)
    {
        $form = $this->createForm(AuthorFormType::class);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $author = new Author();
            $author -> setName($data['name']);

            $em->persist($author);
            $em->flush();

            //return $this->redirectToRoute('home');
        }

        return $this->render('newauthor.html.twig',[ 'authorForm' => $form->createView()] );
    }


}