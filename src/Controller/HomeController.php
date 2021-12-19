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
use Doctrine\Persistence\ManagerRegistry;


class HomeController extends AbstractController
{
    /**
     * @Route("/", methods={"GET", "POST"}, name="home_index")
     */
    public function index(Request $request, ManagerRegistry $managerRegistry): Response
    {
        $entityManager = $managerRegistry->getManager();
        $repository = $managerRegistry->getRepository(Argonautes::class);

        $form = $this->createForm(ArgonautesType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($form->getData());
            $entityManager->flush();

            $form = $this->createForm(ArgonautesType::class);
        }

        $argonautes = $repository->findAll();

        return $this->render(
            'home/index.html.twig', [
                'argonautes' => $argonautes,
                'form'       => $form->createView(),
            ]
       );
    }
}