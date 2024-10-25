<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/', name : 'main')]
class MainController extends AbstractController
{
    #[Route('', name: '_index', methods: ['GET'])]
    public function home(): Response
    {
        return $this->render('main/main.html.twig');
    }

       //route page about-us
    #[Route('about-us', name: '_about_us', methods: ['GET'])]
    public function aboutUs(): Response
    {
        //todo: adapter template
        return $this->render('main/main.html.twig');
    }
}
