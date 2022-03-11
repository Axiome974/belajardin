<?php

namespace App\Controller\Backoffice;

use App\Entity\Diapositive;
use App\Form\DiapositiveType;
use App\Repository\DiapositiveRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/backoffice/main-carousel", name="backoffice_carousel_")
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

    /**
     * @Route("/add", name="add")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param FileUploader $fileUploader
     * @return Response
     */
    public function add(
        Request $request,
        EntityManagerInterface $manager,
        FileUploader $fileUploader
    ): Response
    {
        $diapo = new Diapositive();
        $diapo->setPosition(1);
        $form = $this->createForm(DiapositiveType::class, $diapo);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){
            $file = $form->get("picture")->getData();
            $fileUploader->attachFile( $diapo, $file);
            return $this->redirectToRoute("backoffice_carousel_index");
        }

        return $this->render("backoffice/carousel/add.html.twig", [
            "form"  => $form->createView()
        ]);

    }

    /**
     * @Route("/{id}/delete", name="delete")
     * @param Diapositive $diapositive
     * @param EntityManagerInterface $manager
     * @return RedirectResponse
     */
    public function delete(
        Diapositive $diapositive,
        EntityManagerInterface $manager
    ): RedirectResponse
    {
            $manager->remove($diapositive);
            $manager->flush();
        return $this->redirectToRoute("backoffice_carousel_index");
    }
}
