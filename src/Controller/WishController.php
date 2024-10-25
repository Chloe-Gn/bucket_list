<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
