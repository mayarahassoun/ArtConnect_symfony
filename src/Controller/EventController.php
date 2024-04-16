<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/event')]
class EventController extends AbstractController
{

    #[Route('/', name: 'app_event_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $events = $entityManager
            ->getRepository(Event::class)
            ->findAll();

        return $this->render('event/index.html.twig', [
            'events' => $events,
        ]);
    }
    #[Route('/admin', name: 'display_admin', methods: ['GET'])]
    public function indexAdmin(EntityManagerInterface $entityManager): Response
    {

        return $this->render('Admin/index.html.twig'
        );
    }

    #[Route('/new', name: 'app_event_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('eventpath')->getData();
    
            // Check if a file has been uploaded
            if ($image) {
                // Get the original filename
                $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                // Generate a unique identifier to append to the filename
                $uniqueIdentifier = uniqid();
                // Ensure that the unique identifier doesn't contain characters that could cause issues in filenames
                $safeUniqueIdentifier = preg_replace('/[^a-z0-9]/', '', $uniqueIdentifier);
                // Combine the original filename, the unique identifier, and the file extension
                $safeFilename = $originalFilename . '-' . $safeUniqueIdentifier . '.' . $image->getClientOriginalExtension();
                // Move the file to the directory where images are stored
                $image->move(
                    $this->getParameter('kernel.project_dir') . '/public/uploadedimages',
                    $safeFilename
                );
                // Set the image path in the Evenment entity
                $event->setEventpath($safeFilename);
            }
            
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event/new.html.twig', [
            'event' => $event,
            'f' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_event_show', methods: ['GET'])]
    public function show(Event $event): Response
    {
        return $this->render('event/show.html.twig', [
            'event' => $event,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_event_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Event $event, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event/edit.html.twig', [
            'event' => $event,
            'f' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_event_delete', methods: ['POST'])]
    public function delete(Request $request, Event $event, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $entityManager->remove($event);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
    }
}
