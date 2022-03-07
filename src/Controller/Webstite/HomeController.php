<?php

namespace App\Controller\Webstite;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route ("/", name="home_")
 *
 */
class HomeController extends AbstractController
{
    /**
     * @Route("", name="index")
     */
    public function index(): Response
    {
        return $this->render('webstite/home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
