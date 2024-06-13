<?php

namespace App\Controller;

use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/wish', name : "wish_")]
class WishController extends AbstractController
{
    #[Route('/list', name: "list_home")]
    #[Route('', name: 'list')]
    public function list(WishRepository $wishRepository): Response
    {
//        $wishes = $wishRepository->findRecently();
        $wishes = $wishRepository->findBy(["isPublished" => true], ["dateCreated" => "DESC"]);

        return $this->render('wish/list.html.twig', [
            'wishes' => $wishes
        ]);
    }

    #[Route('/detail/{id}', name: "detail", requirements: ['id' => '\d+'])]
    public function detail(int $id, WishRepository $wishRepository): Response
    {
        //récupération d'un souhait en fonction de son id
        $wish = $wishRepository->find($id);

        //si je n'ai pas de wish je renvoie une 404
        if(!$wish){
            throw $this->createNotFoundException("Ooops ! Not found !");
        }

        return $this->render('wish/detail.html.twig', [
            'wish' => $wish
        ]);
    }





}
