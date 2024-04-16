<?php

namespace App\Controller;

use App\Entity\Partenaire;
use App\Form\PartenaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/partenaire')]
class PartenaireController extends AbstractController
{
   /* #[Route('/', name: 'app_partenaire_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $partenaires = $entityManager
            ->getRepository(Partenaire::class)
            ->findAll();

        return $this->render('Admin/index.html.twig', [
            'partenaires' => $partenaires,
        ]);
    }*/

    

    #[Route('/admin', name: 'display_admin', methods: ['GET'])]
    public function indexAdmin(EntityManagerInterface $entityManager): Response
    {

        $partenaires = $entityManager
            ->getRepository(Partenaire::class)
            ->findAll();

        return $this->render('Admin/index.html.twig', [
            'partenaires' => $partenaires,
        ]);
    }

    #[Route('/client', name: 'display_client', methods: ['GET'])]


    public function indexClient(EntityManagerInterface $entityManager): Response
    {

        $partenaires = $entityManager
            ->getRepository(Partenaire::class)
            ->findAll();

        return $this->render('Client/index.html.twig', [
            'partenaires' => $partenaires,
        ]);
    }

    #[Route('/new', name: 'app_partenaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $partenaire = new Partenaire();
        $form = $this->createForm(PartenaireType::class, $partenaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($partenaire);
            $entityManager->flush();

            return $this->redirectToRoute('display_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('partenaire/new.html.twig', [
            'partenaire' => $partenaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_partenaire_show', methods: ['GET'])]
    public function show(Partenaire $partenaire): Response
    {
        return $this->render('partenaire/show.html.twig', [
            'partenaire' => $partenaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_partenaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Partenaire $partenaire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PartenaireType::class, $partenaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('display_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('partenaire/edit.html.twig', [
            'partenaire' => $partenaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_partenaire_delete', methods: ['POST'])]
    public function delete(Request $request, Partenaire $partenaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$partenaire->getId(), $request->request->get('_token'))) {
            $entityManager->remove($partenaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('display_admin', [], Response::HTTP_SEE_OTHER);
    }
}
