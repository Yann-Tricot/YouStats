<?php


namespace App\Controller;

use App\Repository\CountryRepository;
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

    public function __construct(CountryRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->entityManager = $em;
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
        #  return new JsonResponse($channels);
    }

    /**
     * @Route("/api", name="api_index")
     **/
    public function api() { // test renvoi formulaire json
        $data = [
            'test' => 'hello world',
            "table" => ['C’est pas faux','oui','Johnny Halliday', 'MacDonalds']
        ];
        return new JsonResponse($data);
    }



    /**
     * @Route("/countries/{slug}-{id}", name="country.showVid")
     **/
    #requirements={"slug": "[a-z0-9\-]*"})
    public function show(\App\Entity\Country $country, string $slug) : Response
    {
        if ($country->getSlug() !== $slug) {
            return $this->redirectToRoute('country.showVid', [
                'id' => $country->getId(),
                'slug' => $country->getSlug()
            ], 301);

        }

        return $this->render('country\showCountry.html.twig', [
            'country' => $country,
        ]);
    }

    /**
     * @Route("/countries/{slug}-{id}", name="country.showChan")
     **/
    #requirements={"slug": "[a-z0-9\-]*"})
    public function showChan(\App\Entity\Channel $channel, string $slug) : Response
    {
        if ($channel->getSlug() !== $slug) {
            return $this->redirectToRoute('country.showChan', [
                'name' => $channel->getChannelId(),
                'slug' => $channel->getSlug()
            ], 301);

        }

        return $this->render('country\showCountry.html.twig', [
            'channel' => $channel,
        ]);
    }



}