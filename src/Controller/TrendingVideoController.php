<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;

class TrendingVideoController extends AbstractController
{
    /**
     * @var Environment
     */
    private $twig;

    public function __construct(Environment $twig){
        $this->twig = $twig;
    }


    /**
     * @Route ("/trendingVideo", name="trendingVideo")
     */
    public function index():Response{
        return $this->render('pages/trendingVideo.html.twig');
    }
}