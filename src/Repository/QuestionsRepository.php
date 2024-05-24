<?php

namespace App\Repository;

use App\Entity\Questions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @extends ServiceEntityRepository<Questions>
 *
 * @method Questions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Questions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Questions[]    findAll()
 * @method Questions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Questions::class);
    }

    /**
     * @return Questions[]
     */
    public function findAllWithUsersSortedByDate(): array
    {
        return $this->createQueryBuilder('q')
            ->leftJoin('q.user', 'u')
            ->addSelect('u')
            // trie par date d'ajout
            ->orderBy('q.dateN', 'DESC')
            ->getQuery()
            ->getResult();
    }
        /**
     * @return Reponses[] Returns an array of Reponses objects
     */
    public function findAllByDate(): array
    {
        return $this->createQueryBuilder('r')
            ->orderBy('r.dateN', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
