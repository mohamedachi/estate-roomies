<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\CategoriePromotion;
use App\Entity\Promotion;
use App\Form\CategorieType;

class CategoriePromotionController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie_promotion')]
    public function index(): Response
    {
        return $this->render('categorie_promotion/index.html.twig', [
            'controller_name' => 'CategoriePromotionController',
        ]);
    }

    #[Route('categorie/add_categorie', name: 'categorie_add')]
    public function add(ManagerRegistry $doctrine,Request $req): Response {
        $em = $doctrine->getManager();
        $categorie = new CategoriePromotion();
        $form = $this->createForm(CategorieType::class,$categorie);
        $form->handleRequest($req);
        if($form->isSubmitted()){
            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute('categorie_fetch');
        }
        
        return $this->renderForm('categorie_promotion/add.html.twig',['form'=>$form]);
    }

    #[Route('/categorie/fetch', name: 'categorie_fetch')]
    public function afficher_promotion(ManagerRegistry $doctrine): Response
    {
        $listCateggorie= $doctrine->getRepository(CategoriePromotion::class)->findAll();
        //$club= $doctrine->getRepository(Club::class)->find('1');
        return $this->render('categorie_promotion/index.html.twig', [
            'categories' => $listCateggorie,
            
        ]);
    }

    #[Route('categorie/remove/{id}', name: 'categorie_remove')]
    public function remove(ManagerRegistry $doctrine,$id): Response
    {
        $em= $doctrine->getManager();
        $categorie= $doctrine->getRepository(CategoriePromotion::class)->find($id);
        $em->remove($categorie);
        $em->flush();
        return $this->redirectToRoute('categorie_fetch');
    }

    #[Route('categorie/update/{id}', name: 'categorie_update')]
    public function update(ManagerRegistry $doctrine,$id,Request $req): Response {
        $em = $doctrine->getManager();
        $categorie = $doctrine->getRepository(CategoriePromotion::class)->find($id);
        $form = $this->createForm(CategorieType::class,$categorie);
        $form->handleRequest($req);
        if($form->isSubmitted()){
            $em->persist($categorie);
            $em->flush();
            return $this->redirectToRoute('categorie_fetch');
        }
        return $this->renderForm('categorie_promotion/add.html.twig',['form'=>$form]);

    }
}
