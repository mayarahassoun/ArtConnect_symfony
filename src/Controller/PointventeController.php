<?php

namespace App\Controller;

use App\Entity\Pointvente;
use App\Form\PointventeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pointvente')]
class PointventeController extends AbstractController
{
    #[Route('/', name: 'app_pointvente_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $pointventes = $entityManager
            ->getRepository(Pointvente::class)
            ->findAll();

        return $this->render('pointvente/index.html.twig', [
            'pointventes' => $pointventes,
        ]);
    }

    #[Route('/new', name: 'app_pointvente_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $pointvente = new Pointvente();
        $form = $this->createForm(PointventeType::class, $pointvente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($pointvente);
            $entityManager->flush();

            return $this->redirectToRoute('app_pointvente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pointvente/new.html.twig', [
            'pointvente' => $pointvente,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pointvente_show', methods: ['GET'])]
    public function show(Pointvente $pointvente): Response
    {
        return $this->render('pointvente/show.html.twig', [
            'pointvente' => $pointvente,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_pointvente_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pointvente $pointvente, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PointventeType::class, $pointvente);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_pointvente_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pointvente/edit.html.twig', [
            'pointvente' => $pointvente,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pointvente_delete', methods: ['POST'])]
    public function delete(Request $request, Pointvente $pointvente, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pointvente->getId(), $request->request->get('_token'))) {
            $entityManager->remove($pointvente);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_pointvente_index', [], Response::HTTP_SEE_OTHER);
    }
}
