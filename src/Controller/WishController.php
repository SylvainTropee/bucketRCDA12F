<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/wish', name: "wish_")]
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
        if (!$wish) {
            throw $this->createNotFoundException("Ooops ! Not found !");
        }

        return $this->render('wish/detail.html.twig', [
            'wish' => $wish
        ]);
    }

    #[Route('/create', name: "create")]
    #[Route('/update/{id}', name: "update")]
    public function createOrUpdate(
        Request                $request,
        EntityManagerInterface $entityManager,
        WishRepository         $wishRepository,
        int                    $id = null): Response
    {
        if($id){
            $wish = $wishRepository->find($id);
        }else{
            $wish = new Wish();
            $wish->setDateCreated(new \DateTime());
            $wish->setPublished(true);
        }

        $wishForm = $this->createForm(WishType::class, $wish);

        $wishForm->handleRequest($request);

        if ($wishForm->isSubmitted() && $wishForm->isValid()) {
            //je set les éléments non gérables par l'utilisateur
            $entityManager->persist($wish);
            $entityManager->flush();

            $this->addFlash('success', 'Wish has been created !');
            return $this->redirectToRoute('wish_detail', ['id' => $wish->getId()]);
        }
        return $this->render('wish/create.html.twig', [
            'wishForm' => $wishForm
        ]);
    }


}
