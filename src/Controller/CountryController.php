<?php


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class CountryController extends AbstractController
{
    /**
     * @Route("/", name="country")
     **/
    public  function indexCountry()
    {

        dump(['hello' => 'world']);
        return $this->render('indexCountry.html.twig', [ 'title' => 'Hello world']);
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
}