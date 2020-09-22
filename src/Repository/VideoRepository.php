<?php


namespace App\Repository;

use App\Entity\Video;
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

}
