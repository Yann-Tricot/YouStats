<?php


namespace App\Controller;

use App\Repository\ChannelRepository;
use App\Repository\CategoryRepository;
use App\Repository\CountryRepository;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class CountryController extends AbstractController
{
    /**
     * @var CountryRepository
     */
    private $repository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var VideoRepository
     */
    private $videoRepository;

    /**
     * @var ChannelRepository
     */
    private $channelRepository;

    /**
     * @var CategoryRepository
     */
    private $categorRepository;

    public function __construct(CountryRepository $repository, VideoRepository $vRepo, ChannelRepository $chanRepo, CategoryRepository $catRepo, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->entityManager = $em;
        $this->videoRepository = $vRepo;
        $this->channelRepository = $chanRepo;
        $this->categorRepository = $catRepo;
    }

    /**
     * @Route("/countries", name="countries")
    **/
    public function list(EntityManagerInterface $em)
    {
        $countries = $this->repository->findAll();

        if(!$countries)
        {
            throw $this->createNotFoundException('Error no videos found !');
        }
        return $this->render('country\indexCountry.html.twig', ['countries'=> $countries]);

    }

//changer les slugs -> on recup le country depuis les videos et les channels


    /**
     * @Route("/countries/{slug}-{id}", name="country.showCountry")
     **/
    #requirements={"slug": "[a-z0-9\-]*"})
    public function show(\App\Entity\Country $country, string $slug) : Response
    {
        $countries = $this->repository->findAll();

        if ($country->getSlug() !== $slug) {
            return $this->redirectToRoute('country.showCountry', [
                'id' => $country->getId(),
                'slug' => $country->getSlug()
            ], 301);

        }

        $videos = $this->videoRepository->findAllByCountry($country);
        $channels = $this->channelRepository->findAllByCountry($country->getId());
        $categories = $this->categorRepository->findAll();
        return $this->render('country\showCountry.html.twig', [
            'country' => $country, 'videos'=>$videos, 'channels'=>$channels, 'countries'=> $countries, 'categories'=> $categories
        ]);
    }
}