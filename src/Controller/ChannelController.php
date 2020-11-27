<?php


namespace App\Controller;

use App\Entity\Channel;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ChannelRepository;


class ChannelController extends AbstractController
{
    /**
     * @var ChannelRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(ChannelRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }


    /**
     * @Route("/mychannels")
     **/
    public function list(EntityManagerInterface $em)
    {

        $channels = $this->repository->findAll();
        if(!$channels)
        {
            throw $this->createNotFoundException('Error no channels found !');
        }
        return $this->render('indexChannel.html.twig', ['channels'=> $channels]);
    }
}