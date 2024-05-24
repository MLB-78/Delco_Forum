<?php

namespace App\Controller;

use App\Entity\Questions;
use App\Entity\Reponses;
use App\Form\QuestionFormType;
use App\Form\ReponseType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionsController extends AbstractController
{
    /**
     * @Route("/questions", name="app_questions")
     */
    public function index(Request $request): Response
    {
        $question = new Questions();
        $form = $this->createForm(QuestionFormType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $question->setUser($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($question);
            $entityManager->flush();

            return $this->redirectToRoute('app_questions');
        }

        $questions = $this->getDoctrine()->getRepository(Questions::class)->findAllWithUsersSortedByDate();

        return $this->render('questions/questions.html.twig', [
            'form' => $form->createView(),
            'questions' => $questions,
        ]);
    }

    /**
     * @Route("/question/{id}/repondre", name="repondre_question")
     */
    public function repondreQuestion(Request $request, $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $question = $entityManager->getRepository(Questions::class)->find($id);

        if (!$question) {
            throw $this->createNotFoundException('La question demandée n\'existe pas');
        }

        $reponse = new Reponses();
        $reponseForm = $this->createForm(ReponseType::class, $reponse);
        $reponseForm->handleRequest($request);

        if ($reponseForm->isSubmitted() && $reponseForm->isValid()) {
            $user = $this->getUser();
            $reponse->setUser($user);
            $reponse->setQuestion($question);
            $reponse->setDateN(new \DateTime());

            $entityManager->persist($reponse);
            $entityManager->flush();

            return $this->redirectToRoute('repondre_question', ['id' => $question->getId()]);
        }

        return $this->render('questions/reponses.html.twig', [
            'question' => $question,
            'reponse_form' => $reponseForm->createView(),
        ]);
    }
}
