<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoryRepository;
use App\Repository\VideoRepository;
use App\Repository\CountryRepository;
use Twig\Environment;

/*
 * Controller pour la gestion de la page "creation de la video parfaite"
 */
class PerfectVideoController extends AbstractController
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * @var CountryRepository
     */
    private $countryRepository;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var VideoRepository
     */
    private $videoRepository;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;


    public function __construct(Environment $twig, CountryRepository $countryRepository, VideoRepository $videoRepository, CategoryRepository $categoryRepository, EntityManagerInterface $em)
    {
        $this->twig = $twig;
        $this->countryRepository = $countryRepository;
        $this->videoRepository = $videoRepository;
        $this->categoryRepository = $categoryRepository;
        $this->entityManager = $em;
    }

    /**
     * @Route ("/perfectVideo", name="perfectVideo")
     * @return Response
     */
    public function index():Response{
        $categories = $this->categoryRepository->findBestCategoriesOfAllVideos(3);
        $videos = $this->videoRepository->findBestVideoOfAllVideos();
        $countries = $this->countryRepository->findBestCountryOfAllVideos(3);
        return $this->render('pages/perfectVideo.html.twig',[
            'categories'=>$categories, 'videos'=>$videos, 'countries'=>$countries
        ]);
    }
}