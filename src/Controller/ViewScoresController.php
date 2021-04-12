<?php

namespace App\Controller;

use App\Repository\ScoresRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(Request $request): Response
    {
        $filteredRequestUsername = filter_var($request->query->get('filter_username'), FILTER_VALIDATE_INT);
        $filteredRequestScore = filter_var($request->query->get('filter_score'), FILTER_VALIDATE_INT);
        $filteredRequestDifficulty = filter_var($request->query->get('filter_difficulty'), FILTER_VALIDATE_INT);

        $scores = $this->scoresRepository->findByFilter(
            is_bool($filteredRequestUsername) ? null : $filteredRequestUsername,
            is_bool($filteredRequestScore) ? null : $filteredRequestScore,
            is_bool($filteredRequestDifficulty) ? null : $filteredRequestDifficulty
        );
        return $this->render('homepage.html.twig', [
            'scores' => $scores,
            'filter' => [
                'username' => $filteredRequestUsername,
                'score' => $filteredRequestScore,
                'difficulty' => $filteredRequestDifficulty
            ]
        ]);
    }
}
