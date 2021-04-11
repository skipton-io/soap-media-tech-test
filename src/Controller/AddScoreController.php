<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddScoreController extends AbstractController
{
    /**
     * @Route("/scores/add-score", name="add_score")
     */
    public function index(): Response
    {
        return $this->render('add-score/index.html.twig');
    }
}
