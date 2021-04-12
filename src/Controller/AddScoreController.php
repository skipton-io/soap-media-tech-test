<?php

namespace App\Controller;

use App\Entity\Scores;
use App\Form\AddScoreType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddScoreController extends AbstractController
{
    /**
     * @Route("/scores/add-score", name="add_score")
     */
    public function index(Request $request): Response
    {
        $score = new Scores();
        $form = $this->createForm(AddScoreType::class, $score);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $score->setUser($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($score);
            $entityManager->flush();

            return $this->redirectToRoute('view_scores');
        }

        return $this->render('add-score/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
