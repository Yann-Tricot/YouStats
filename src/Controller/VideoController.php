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
     * @Route("/videos")
     **/
    public function list(EntityManagerInterface $em)
    {
        $country = 'FR';

        $videos = $this->repository->findAllByCountry($country);

        if(!$videos)
        {
            throw $this->createNotFoundException('Error no videos found !');
        }
        return $this->render('/country/indexVideo.html.twig', ['videos'=> $videos]);
        #  return new JsonResponse($channels);
    }

//    /**
//     * @Route("/videos/{slug}-{id}", name="country.show")
//     **/
//    #requirements={"slug": "[a-z0-9\-]*"})
//    public function show(\App\Entity\Video $video, string $slug) : Response
//    {
//        if ($video->getSlug() !== $slug)
//        {
//            return $this->redirectToRoute('country.show', [
//                'name' => $video->getId(),
//                'slug' => $video->getSlug()
//            ], 301);
//        }
//        return $this->render('/country/indexCountry.html.twig', [
//            'video' => $video,
//        ]);
//    }
}