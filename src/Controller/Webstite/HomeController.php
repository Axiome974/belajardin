<?php

namespace App\Controller\Webstite;

use App\Repository\AboutSectionRepository;
use App\Repository\ContactRepository;
use App\Repository\DiapositiveRepository;
use App\Repository\PortfolioSectionRepository;
use App\Repository\ServiceSectionRepository;
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
        AboutSectionRepository $aboutSectionRepository,
        ServiceSectionRepository $serviceSectionRepository,
        PortfolioSectionRepository $portfolioSectionRepository,
        ContactRepository $contactRepository
    ): Response
    {
        return $this->render('webstite/home/index.html.twig', [
            "diapositives"      => $diapositiveRepository->findAll(),
            "about"             => $aboutSectionRepository->findOneBy([], ["id" => "DESC"]),
            "service"           => $serviceSectionRepository->findOneBy([], ["id" => "DESC"]),
            "portfolio"         => $portfolioSectionRepository->findOneBy([], ["id" => "DESC"]),
            "contact"           => $contactRepository->findOneBy([], ["id" => "DESC"])
        ]);
    }
}
