<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Wish;
use App\Form\AjouterWishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/wish', name : 'wish')]
class WishController extends AbstractController
{

    //route vers liste
    #[Route('', name: '_liste', methods: ['GET'])]
    public function wishListe(WishRepository $wishRepository): Response
    {

        $wishes = $wishRepository->findBy([],['dateCreated' => 'DESC']);

        //todo: maj template
        return $this->render('wish/liste.html.twig',
        ['wishes' => $wishes]);
    }




    //route ajouter voeux
    #[Route('/ajouter', name: '_ajouter')]
    public function ajouter(Request $request, EntityManagerInterface $em): Response
    {
        $wish = new Wish();

        $form = $this->createForm(AjouterWishType::class, $wish);

        $form->handleRequest($request);

        return $this->render('wish/edit.html.twig', ['form' => $form]);


       //todo : terminer controller à partir de /create dans series_app
    }


    //route vers detail
    #[Route('/{id}', name: '_detail', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function wishDetail(WishRepository $wishRepository, ?int $id = null): Response
    {
        $wish = $wishRepository->find($id);

        if (!$wish) {

            throw $this->createNotFoundException();
        }

        //todo: maj template
        return $this->render('wish/detail.html.twig',
        ['wish' => $wish]);
    }
}
