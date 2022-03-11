<?php

namespace App\Controller\Webstite;

use App\Repository\AboutSectionRepository;
use App\Repository\DiapositiveRepository;
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
    public function index(
        DiapositiveRepository $diapositiveRepository,
        AboutSectionRepository $aboutSectionRepository
    ): Response
    {
        return $this->render('webstite/home/index.html.twig', [
            "diapositives"      => $diapositiveRepository->findAll(),
            "about"             => $aboutSectionRepository->findOneBy([], ["id" => "DESC"])
        ]);
    }
}
