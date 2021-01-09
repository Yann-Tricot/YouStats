<?php


namespace App\Repository;

use App\Entity\Channel;
use App\Entity\Video;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;



class ChannelRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Channel::class);
    }


    public function findAllByCountry($country)
    {
        return $this->createQueryBuilder('c')
            ->where('c.countryId = :cnt')
            ->setParameter('cnt', $country)
            ->getQuery()
            ->getResult();
    }


    public function findOneBySomeField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.channelName = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findBestChannelsFromVideos(int $MaxResult): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Entity\Channel c
            JOIN App\Entity\Video v
            WHERE v.channelId = c.channelId
            GROUP BY v.channelId
            ORDER BY SUM(v.countView) DESC'
        )->setMaxResults($MaxResult);
        return $query->getResult();
    }
}