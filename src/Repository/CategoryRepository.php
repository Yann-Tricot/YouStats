<?php


namespace App\Repository;


use App\Entity\Category;
use App\Entity\Video;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;

class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function findBestCategoriesOfAllVideos(int $MaxResult): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Entity\Category c
            JOIN App\Entity\Video v
            WHERE v.categoryId = c.categoryId
            GROUP BY v.categoryId
            ORDER BY COUNT(v.id) DESC'
        )->setMaxResults($MaxResult);
        return $query->getResult();
    }

    public function findAll()
    {
        return $this->createQueryBuilder('c')
            ->getQuery()
            ->getResult();
    }
}