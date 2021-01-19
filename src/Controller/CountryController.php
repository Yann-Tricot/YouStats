<?php


namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ChannelRepository;
use App\Repository\CountryRepository;
use App\Repository\VideoRepository;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Twig\Environment;

/*
 * Controller qui permet la gestion / recuperation et affichage des données en fonction des pays sélectionnés
 */

class CountryController extends AbstractController
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
     * @var ChannelRepository
     */
    private $channelRepository;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    private $videos, $channels, $categories;

    public function __construct(Environment $twig, CountryRepository $countryRepository, VideoRepository $vRepo, CategoryRepository $categoryRepository,
                                ChannelRepository $chanRepo, EntityManagerInterface $em)
    {
        $this->twig = $twig;
        $this->countryRepository = $countryRepository;
        $this->entityManager = $em;
        $this->videoRepository = $vRepo;
        $this->channelRepository = $chanRepo;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @Route("/alexsbogoss", name="countries")
     **/
    public function list(EntityManagerInterface $em)
    {
        $countries = $this->countryRepository->findAll();

        if (!$countries) {
            throw $this->createNotFoundException('Error no videos found !');
        }
        return $this->render('country\indexCountry.html.twig', ['countries' => $countries]);

    }

    /**
     * @Route("/countries/{slug}-{id}", name="country.showCountry")
     **/
    #requirements={"slug": "[a-z0-9\-]*"})
    public function show(\App\Entity\Country $country, string $slug, Request $request): Response
    {
        $countries = $this->countryRepository->findAll();

        //Renvoi des données pour la génération de l'url de la route
        if ($country->getSlug() !== $slug) {
            return $this->redirectToRoute('country.showCountry', [
                'id' => $country->getId(),
                'slug' => $country->getSlug()
            ], 301);

        }

        $date = new \DateTime();
        //Formatage de la date
        $date->setDate(2021,01,11);
        $date->setTime(00, 00, 00.000000);
        //Soustraction d'un jour pour récuperer les données du jour d'avant à l'affichage de showCountry
        //$date->sub(new \DateInterval('P1D'));
        //$date->add(\DateInterval::createFromDateString('yesterday'));

        $this->sortByDateAndCountry($date, $country);


        $dateForm = $this->createForm(DateType::class, $date);
        $dateForm->handleRequest($request);

        if (empty($this->videos) | empty($this->channels) | empty($this->categories)) {
            return $this->render('pages\error404.html.twig', [
                'id' => $country->getId(),
                'slug' => $country->getSlug()
            ]);
        }

        if ($dateForm->isSubmitted() && $dateForm->isValid()) {
            $date = $dateForm->getData();
            if ($date != null) {
                $this->sortByDateAndCountry($date, $country);
                if (empty($this->videos) | empty($this->channels) | empty($this->categories)) {
                    return $this->render('pages\error404.html.twig', [
                        'id' => $country->getId(),
                        'slug' => $country->getSlug()
                    ]);
                }
                return $this->render('country\showCountry.html.twig', [
                    'country' => $country,
                    'videos' => $this->videos,
                    'channels' => $this->channels,
                    'countries' => $countries,
                    'categories' => $this->categories,
                    'date' => $date,
                    'dateForm' => $dateForm->createView()
                ]);
            }
        }

        return $this->render('country\showCountry.html.twig', [
            'country' => $country,
            'videos' => $this->videos,
            'channels' => $this->channels,
            'countries' => $countries,
            'categories' => $this->categories,
            'date' => $date,
            'dateForm' => $dateForm->createView()
        ]);
    }

    public function sortByDateAndCountry(DateTime $date, $country)
    {
        $this->videos = $this->videoRepository->findAllVideosByOneDay($date, $country->getId());
        $this->channels = $this->channelRepository->findAllChannelsByOneDay($date, $country->getId());
        $this->categories = $this->categoryRepository->findAllCategoriesByOneDay($date, $country->getId());
    }
}