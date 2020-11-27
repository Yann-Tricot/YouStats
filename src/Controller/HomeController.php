<?php
namespace App\Controller;

use App\Repository\ChannelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeController extends AbstractController{

    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig){
        $this->twig = $twig;
    }

    /**
     * @param ChannelRepository $repository
     * @Route ("/home", name="home")
     * @return Response
     */
    public function index(ChannelRepository $repository):Response{
        $channels = $repository->findTheTop3();
        return $this->render('pages/home.html.twig',[
            'channels' => $channels
        ]);
    }
}