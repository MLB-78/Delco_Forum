<?php
// src/Controller/QuestionsController.php

namespace App\Controller;

use App\Entity\Questions;
use App\Form\QuestionFormType;
use App\Service\QuestionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionsController extends AbstractController
{
    private $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    /**
     * @Route("/questions", name="app_questions")
     */
    public function index(Request $request): Response
    {
        $question = new Questions();
        $form = $this->createForm(QuestionFormType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupère l'utilisateur connecté
            $user = $this->getUser();
            
            // Assigne l'utilisateur à la question
            $question->setUser($user);

            // Traitement du formulaire ici, par exemple, enregistrer la question en base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($question);
            $entityManager->flush();

            // Redirection après soumission du formulaire
            return $this->redirectToRoute('app_questions');
        }

        // Récupérer toutes les questions avec les utilisateurs
        $questions = $this->getDoctrine()->getRepository(Questions::class)->findAllWithUsers();

        return $this->render('questions/questions.html.twig', [
            'form' => $form->createView(),
            'questions' => $questions, // Passer les questions à la vue Twig
        ]);
    }
}
