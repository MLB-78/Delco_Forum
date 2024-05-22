<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\QuestionsRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(QuestionsRepository $questionsRepository): Response
    {
        // récupére toutes les questions
        $questions = $questionsRepository->findAll();

        return $this->render('base.html.twig', [
            'questions' => $questions,
        ]);
    }
}
