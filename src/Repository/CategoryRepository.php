<?php


namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
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

    public function findAllByCountry($country)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Entity\Category c
            JOIN App\Entity\Video v
            WHERE v.country = :country AND c.categoryId = v.categoryId
            GROUP BY c'
        )->setParameter('country', $country);
        return $query->getResult();
    }

    public function findAllCategoriesByOneDay($day, $country): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Entity\Category c
            JOIN App\Entity\Video v
            WHERE v.country = :country AND v.trendingDate = :day AND c.categoryId = v.categoryId
            GROUP BY c'
        )->setParameter('day', $day)
        ->setParameter('country', $country);
        return $query->getResult();
    }
}