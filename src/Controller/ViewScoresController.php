<?php

namespace App\Controller;

use App\Repository\ScoresRepositoryInterface;
use App\Service\FilterRequest;
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
        $filteredRequestUsername = FilterRequest::toInt($request->query->get('username'));
        $filteredRequestScore = FilterRequest::toInt($request->query->get('score'));
        $filteredRequestDifficulty = FilterRequest::toInt($request->query->get('difficulty'));

        $filteredRequestOrderElement = FilterRequest::inArray($request->query->get('order'), [
            'user', 'score', 'difficulty'
        ]);
        $filteredRequestOrderDirection = FilterRequest::inArray($request->query->get('dir'), [
            'asc', 'desc'
        ]);

        $scores = $this->scoresRepository->findByFilter(
            $filteredRequestUsername,
            $filteredRequestScore,
            $filteredRequestDifficulty,
            $filteredRequestOrderElement,
            $filteredRequestOrderDirection
        );
        return $this->render('homepage.html.twig', [
            'scores' => $scores,
            'filter' => [
                'username' => $filteredRequestUsername,
                'difficulty' => $filteredRequestDifficulty
            ],
            'order' => [
                'order' => $filteredRequestOrderElement,
                'direction' => $filteredRequestOrderDirection
            ]
        ]);
    }
}
