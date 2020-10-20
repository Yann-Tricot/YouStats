<?php





namespace App\Controller;



use App\Entity\Channel;

use Doctrine\ORM\EntityManagerInterface;

use Doctrine\Persistence\ObjectManager;

use Symfony\Component\HttpFoundation\Response;
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

    public function index():Response{
        return $this-> render('');
    }


    /**

     * @Route("/mychannels")

     **/

    /**public function list(EntityManagerInterface $em)

    {

        $country = 'FR';

        // $this->repository = $em->getRepository(Channel::class);



        $channels = $this->repository->findAll();

        $videos = $this->repository->findAll();

        //$videos = $this->repository->findAllByCountry($country);

        if(!$channels)

        {

            throw $this->createNotFoundException('Error no channels found !');

        }

        if(!$videos)

        {

            throw $this->createNotFoundException('Error no videos found !');

        }

        return $this->render('indexChannel.html.twig', ['channels'=> $channels]);

        #  return $this->render('indexCountry.html.twig',['channels'=> $channels]);

        #  return new JsonResponse($channels);

    }**/

}