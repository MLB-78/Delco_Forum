<?php
namespace App\Service;

use App\Entity\Questions;
use Doctrine\ORM\EntityManagerInterface;

class QuestionService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    // récupére les questions
    public function getAllQuestions(): array
    {
        return $this->entityManager->getRepository(Questions::class)->findAll();
    }
}
