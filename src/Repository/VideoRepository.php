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

    public function findTop3ByTendanceVideo(){
        return $this->createQueryBuilder(
            'SELECT COUNT(video_id)AS CV,channel_id,channel_name,SUM(count_view) AS SCV FROM video NATURAL JOIN channel WHERE `trending_date`="2020-09-22" GROUP BY channel_id ORDER BY CV DESC, SCV DESC LIMIT 3'
        )
            ->getQuery()
            ->getResult();
    }

}