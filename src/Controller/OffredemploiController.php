<?php

namespace App\Controller;

use App\Entity\Offredemploi;
use App\Form\OffredemploiType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/offredemploi')]
class OffredemploiController extends AbstractController
{
    #[Route('/', name: 'app_offredemploi_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $offredemplois = $entityManager
            ->getRepository(Offredemploi::class)
            ->findAll();

        return $this->render('offredemploi/index.html.twig', [
            'offredemplois' => $offredemplois,
        ]);
    }
    #[Route('/index1', name: 'app_offredemploi_index1', methods: ['GET'])]
    public function index1(EntityManagerInterface $entityManager): Response
    {
        $offredemplois = $entityManager
            ->getRepository(Offredemploi::class)
            ->findAll();

        return $this->render('offredemploi/index1.html.twig', [
            'offredemplois' => $offredemplois,
        ]);
    }

    #[Route('/admin', name: 'display_admin', methods: ['GET'])]
    public function indexAdmin(EntityManagerInterface $entityManager): Response
    {

        return $this->render('Admin/index.html.twig'
        );
    }

    #[Route('/client', name: 'display_client', methods: ['GET'])]
    public function indexClient(EntityManagerInterface $entityManager): Response
    {

        return $this->render('Client/index.html.twig'
        );
    }

    #[Route('/new', name: 'app_offredemploi_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $offredemploi = new Offredemploi();
        $form = $this->createForm(OffredemploiType::class, $offredemploi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($offredemploi);
            $entityManager->flush();

            return $this->redirectToRoute('app_offredemploi_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('offredemploi/new.html.twig', [
            'offredemploi' => $offredemploi,
            'form' => $form,
        ]);
    }
    

    #[Route('/{id}', name: 'app_offredemploi_show', methods: ['GET'])]
    public function show(Offredemploi $offredemploi): Response
    {
        return $this->render('offredemploi/show.html.twig', [
            'offredemploi' => $offredemploi,
        ]);
    }
    #[Route('/show1/{id}', name: 'app_offredemploi_show1', methods: ['GET'])]
    public function show1(Offredemploi $offredemploi): Response
    {
        return $this->render('offredemploi/show1.html.twig', [
            'offredemploi' => $offredemploi,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_offredemploi_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Offredemploi $offredemploi, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(OffredemploiType::class, $offredemploi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_offredemploi_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('offredemploi/edit.html.twig', [
            'offredemploi' => $offredemploi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_offredemploi_delete', methods: ['POST'])]
    public function delete(Request $request, Offredemploi $offredemploi, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$offredemploi->getId(), $request->request->get('_token'))) {
            $entityManager->remove($offredemploi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_offredemploi_index', [], Response::HTTP_SEE_OTHER);
    }
}
