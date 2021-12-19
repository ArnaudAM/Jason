<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Argonautes;
use App\Repository\ArgonautesRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", methods="GET", name="home_index")
     */
    public function index(): Response
    {
        $argonautes = $this->getDoctrine()
            ->getRepository(Argonautes::class)
            ->findAll();

        return $this->render(
            'home/index.html.twig',
            ['argonautes' => $argonautes]
       );
    }
}
