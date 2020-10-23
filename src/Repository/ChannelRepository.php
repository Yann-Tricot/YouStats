<?php


namespace App\Repository;

use App\Entity\Channel;
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
        return $this->createQueryBuilder('v')
            ->setParameter('cnt', $country)
            ->where('v.country = :cnt')
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

    public function findTheTop3(){
        return $this->createQueryBuilder('c')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
    }
}