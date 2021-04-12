<?php

namespace App\Controller;

use App\Repository\ScoresRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\RouterInterface;

class DeleteScoreController extends AbstractController
{
    protected $scoresRepository;

    protected $entityManager;

    public function __construct(ScoresRepositoryInterface $scoresRepository, EntityManagerInterface $entityManager)
    {
        $this->scoresRepository = $scoresRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/admin/delete/score/{id}", name="delete_score", methods={"GET", "POST"}, requirements={"id"="\d+"})
     */
    public function index(int $id, Request $request, RouterInterface $router): Response
    {
        if ($request->isMethod('POST')) {
            $submittedToken = $request->request->get('token');
            if ($this->isCsrfTokenValid('delete-score', $submittedToken)) {
                $entity = $this->scoresRepository->find($id);
                if ($entity) {
                    $this->entityManager->remove($entity);
                    $this->entityManager->flush();

                    $referrer = $request->request->get('_referrer');
                    if (!$referrer) {
                        $referrer = $router->generate('homepage');
                    }

                    return $this->redirect($referrer);
                }
            }
        }
        return $this->render('delete-score/index.html.twig', [
            'referrer'=> $request->query->get('_referrer')
        ]);
    }
}
