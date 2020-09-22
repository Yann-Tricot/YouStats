<?php


namespace App\Controller;



use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VideoController extends AbstractController
{
    /**
     * @var ChannelRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(VideoRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @Route("/country")
     **/
    public function list(EntityManagerInterface $em)
    {
        $country = 'FR';

        $videos = $this->repository->findAllByCountry($country);

        if(!$videos)
        {
            throw $this->createNotFoundException('Error no videos found !');
        }
        return $this->render('indexCountry.html.twig', ['videos'=> $videos]);
        #  return new JsonResponse($channels);
    }
}