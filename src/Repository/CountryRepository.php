<?php


namespace App\Repository;


use App\Entity\Country;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

class CountryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Country::class);
    }

    public function findLatest() : array
    {
        return $this->findVisibleQuery()
            ->setMaxResults('3')
            ->getQuery()
            ->getResult();
    }

    public function findBestCountryOfAllVideos(int $MaxResult): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Entity\Country c
            JOIN App\Entity\Video v
            WHERE v.country = c.countryId
            GROUP BY v.country
            ORDER BY COUNT(v.id) DESC'
        )->setMaxResults($MaxResult);
        return $query->getResult();
    }
}