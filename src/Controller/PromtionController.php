<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Promotion;
use App\Entity\CategoriePromotion;
use App\Form\PromotionType;
use Symfony\Component\HttpFoundation\Request;

class PromtionController extends AbstractController
{
    #[Route('/bonjour', name: 'bonjour')]
    public function index(): Response
    {
        return $this->render('promtion/index.html.twig', [
            'controller_name' => 'PromtionController',
        ]);
    }

    #[Route('promotion/add', name: 'promotion_add')]
    public function add(ManagerRegistry $doctrine,Request $req): Response {
        $em = $doctrine->getManager();
        $promotion = new Promotion();
        $form = $this->createForm(PromotionType::class,$promotion);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $em->persist($promotion);
            $em->flush();
            return $this->redirectToRoute('promotion_fetch');
        }
        //$club->setName('club test persist');
        //$club->setCreationDate(new \DateTime());
        return $this->renderForm('promotion/add.html.twig',['form'=>$form]);
    }

    #[Route('/promotion/fetch', name: 'promotion_fetch')]
    public function afficher_promotion(ManagerRegistry $doctrine): Response
    {
        $listPromotion= $doctrine->getRepository(Promotion::class)->findAll();
        //$club= $doctrine->getRepository(Club::class)->find('1');
        return $this->render('promotion/index.html.twig', [
            'promotions' => $listPromotion,
            
        ]);
    }

    #[Route('promotion/remove/{id}', name: 'promotion_remove')]
    public function remove(ManagerRegistry $doctrine,$id): Response
    {
        $em= $doctrine->getManager();
        $promotion= $doctrine->getRepository(Promotion::class)->find($id);
        $em->remove($promotion);
        $em->flush();
        return $this->redirectToRoute('promotion_fetch');
    }
    #[Route('promotion/update/{id}', name: 'promotion_update')]
    public function update(ManagerRegistry $doctrine,$id,Request $req): Response {
        $em = $doctrine->getManager();
        $promotion = $doctrine->getRepository(Promotion::class)->find($id);
        $form = $this->createForm(PromotionType::class,$promotion);
        $form->handleRequest($req);
        if($form->isSubmitted()){
            $em->persist($promotion);
            $em->flush();
            return $this->redirectToRoute('promotion_fetch');
        }
        return $this->renderForm('promotion/add.html.twig',['form'=>$form]);

    }

    #[Route('/promotion/afficher', name: 'promotion_afficher')]
    public function afficher_promotion_front(ManagerRegistry $doctrine): Response
    {
        $listPromotion= $doctrine->getRepository(Promotion::class)->findAll();
        //$club= $doctrine->getRepository(Club::class)->find('1');
        return $this->render('promotion/front.html.twig', [
            'promotions' => $listPromotion,
            
        ]);
    }
}
