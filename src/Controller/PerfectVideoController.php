<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class PerfectVideoController extends AbstractController
{

    /**
     * @var Environment
    */
    private $twig;

    public function __construct(Environment $twig){
        $this->twig = $twig;
    }

    /**
     * @Route ("/perfectVideo", name="perfectVideo")
     * @return Response
     */
    public function index():Response{
        return $this->render('pages/perfectVideo.html.twig');
    }
}