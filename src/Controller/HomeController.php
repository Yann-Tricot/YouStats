<?php
namespace App\Controller;

use App\Repository\ChannelRepository;
use App\Repository\VideoRepository;
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
    public function index(ChannelRepository $Charepository, VideoRepository $Vidrepository):Response{
        $channels = $Charepository->findTheTop3();
        return $this->render('pages/home.html.twig',[
            'channels' => $channels,
        ]);
    }
}