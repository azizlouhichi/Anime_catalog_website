<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Anime;


class AnimeController extends AbstractController
{
    #[Route('/anime/{id}', name: 'app_anime', methods: ['GET'])]
    public function index(Anime $anime): Response
    {
        return $this->render('anime/index.html.twig', [
            'anime' => $anime,
        ]);
    }
}
