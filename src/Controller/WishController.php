<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/wish', name : "wish_")]
class WishController extends AbstractController
{
    #[Route('/list', name: "list_home")]
    #[Route('', name: 'list')]
    public function list(): Response
    {
        return $this->render('wish/list.html.twig');
    }

    #[Route('/detail/{id}', name: "detail", requirements: ['id' => '\d+'])]
    public function detail(int $id): Response
    {
        dump($id);
        return $this->render('wish/detail.html.twig');
    }





}
