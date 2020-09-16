<?php


namespace App\Controller;

use App\Entity\Channel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;


class ChannelController extends AbstractController
{

    /**
     * @Route("/mychannels")
     **/
    public function list(EntityManagerInterface $em)
    {
        $repository = $em->getRepository(Channel::class);
        $channels = $repository->findAll();

        if(!$channels)
        {
            throw $this->createNotFoundEsception('Error no channels found !');
        }
        return $this->render('indexCountry.html.twig',['channels'=> $channels]);
      #  return new JsonResponse($channels);
    }
}