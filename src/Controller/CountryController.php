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


class CountryController extends AbstractController
{
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

    public function __construct(CountryRepository $countryRepository, VideoRepository $vRepo, CategoryRepository $categoryRepository,
                                ChannelRepository $chanRepo, EntityManagerInterface $em)
    {
        $this->countryRepository = $countryRepository;
        $this->entityManager = $em;
        $this->videoRepository = $vRepo;
        $this->channelRepository = $chanRepo;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @Route("/countries", name="countries")
    **/
    public function list(EntityManagerInterface $em)
    {
        $countries = $this->countryRepository->findAll();

        if(!$countries)
        {
            throw $this->createNotFoundException('Error no videos found !');
        }
        return $this->render('country\indexCountry.html.twig', ['countries'=> $countries]);

    }

    /**
     * @Route("/countries/{slug}-{id}", name="country.showCountry")
     **/
    #requirements={"slug": "[a-z0-9\-]*"})
    public function show(\App\Entity\Country $country, string $slug,Request $request) : Response
    {
        $countries = $this->countryRepository->findAll();

        if ($country->getSlug() !== $slug) {
            return $this->redirectToRoute('country.showCountry', [
                'id' => $country->getId(),
                'slug' => $country->getSlug()
            ], 301);

        }

        $this->videos = $this->videoRepository->findAllByCountry($country);
        $this->channels = $this->channelRepository->findAllByCountry($country->getId());
        $this->categories = $this->categoryRepository->findAllByCountry($country->getId());

        $date = new \DateTime();

        $dateForm = $this->createForm(DateType::class, $date, [
            'widget' => 'single_text',
            'attr' => ['class' => 'js-datepicker'],
            'html5' => false,
        ]);
        $dateForm->handleRequest($request);
        if ($dateForm->isSubmitted() && $dateForm->isValid()) {
            $date = $dateForm->getData();
            if ($date != null) {
                $this->sortByDateAndCountry($date,$country);

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
            'videos'=>$this->videos,
            'channels'=>$this->channels,
            'countries'=> $countries,
            'categories'=>$this->categories,
            'date'=>$date,
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