<?php

namespace App\Controller;

use App\Entity\Argonautes;
use App\Form\ArgonautesType;
use App\Repository\ArgonautesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/argonautes")
 */
class ArgonautesController extends AbstractController
{
    /**
     * @Route("/", name="argonautes_index", methods={"GET"})
     */
    public function index(ArgonautesRepository $argonautesRepository): Response
    {
        return $this->render('argonautes/index.html.twig', [
            'argonautes' => $argonautesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="argonautes_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $argonaute = new Argonautes();
        $form = $this->createForm(ArgonautesType::class, $argonaute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($argonaute);
            $entityManager->flush();

            return $this->redirectToRoute('argonautes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('argonautes/new.html.twig', [
            'argonaute' => $argonaute,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="argonautes_show", methods={"GET"})
     */
    public function show(Argonautes $argonaute): Response
    {
        return $this->render('argonautes/show.html.twig', [
            'argonaute' => $argonaute,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="argonautes_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Argonautes $argonaute, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ArgonautesType::class, $argonaute);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('argonautes_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('argonautes/edit.html.twig', [
            'argonaute' => $argonaute,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="argonautes_delete", methods={"POST"})
     */
    public function delete(Request $request, Argonautes $argonaute, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$argonaute->getId(), $request->request->get('_token'))) {
            $entityManager->remove($argonaute);
            $entityManager->flush();
        }

        return $this->redirectToRoute('argonautes_index', [], Response::HTTP_SEE_OTHER);
    }
}
