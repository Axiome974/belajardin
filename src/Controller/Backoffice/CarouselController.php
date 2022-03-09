<?php

namespace App\Controller\Backoffice;

use App\Repository\DiapositiveRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/backoffice/main-carousel", name="backoffice_main_carousel_")
 * @IsGranted("ROLE_ADMIN")
 */
class CarouselController extends AbstractController
{
    /**
     * @Route("", name="index")
     */
    public function index(
        DiapositiveRepository $diapositiveRepository
    ): Response
    {
        return $this->render('backoffice/carousel/index.html.twig', [
            "diapositives"      => $diapositiveRepository->findAll()
        ]);
    }
}
