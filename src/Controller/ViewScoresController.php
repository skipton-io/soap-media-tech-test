<?php

namespace App\Controller;

use App\Repository\ScoresRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ViewScoresController extends AbstractController
{
    protected ScoresRepositoryInterface $scoresRepository;

    public function __construct(ScoresRepositoryInterface $scoresRepository)
    {
        $this->scoresRepository = $scoresRepository;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        $scores = $this->scoresRepository->findAll();
        return $this->render('homepage.html.twig', [
            'scores' => $scores
        ]);
    }
}
