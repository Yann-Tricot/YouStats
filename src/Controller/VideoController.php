<?php


namespace App\Controller;



use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VideoController extends AbstractController
{
    /**
     * @var VideoRepository
     */
    private $videoRepository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(VideoRepository $repository, EntityManagerInterface $em)
    {
        $this->videoRepository = $repository;
        $this->em = $em;
    }
}