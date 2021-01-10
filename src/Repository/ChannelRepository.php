<?php


namespace App\Repository;

use App\Entity\Channel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;



class ChannelRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Channel::class);
    }


    public function findAllByCountry($country)
    {
        return $this->createQueryBuilder('ch')
            ->where('ch.countryId = :cnt')
            ->setParameter('cnt', $country)
            ->getQuery()
            ->getResult();
    }


    public function findAllChannelsByOneDay($day, $country): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT ch
            FROM App\Entity\Channel ch
            JOIN App\Entity\Video v
            WHERE v.country = :country AND v.trendingDate = :day AND ch.channelId = v.channelId
            GROUP BY ch'
        )->setParameter('day', $day)
            ->setParameter('country', $country);
        return $query->getResult();
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