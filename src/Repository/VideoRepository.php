<?php


namespace App\Repository;

use App\Entity\Category;
use App\Entity\Video;
use App\Entity\Channel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class VideoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Video::class);
    }

    public function findAllByCountry($country)
    {
        return $this->createQueryBuilder('v')
            ->setParameter('cnt', $country)
            ->where('v.country = :cnt')
            ->getQuery()
            ->getResult();
    }

    public function findBestCategoriesOfAllVideos(int $MaxResult): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Entity\Video v 
            JOIN App\Entity\Category c
            WHERE c.categoryId = v.categoryId
            GROUP BY v.categoryId
            ORDER BY COUNT(v.id) DESC'
        )->setMaxResults($MaxResult);
        return $query->getResult();
    }

    public function findBestVideoOfAllVideos(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT v
            FROM App\Entity\Video v
            ORDER BY v.countView DESC'
        )->setMaxResults(1);
        return $query->getResult();
    }
}
