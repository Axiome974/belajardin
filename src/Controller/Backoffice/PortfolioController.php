<?php

namespace App\Controller\Backoffice;

use App\Entity\PortfolioPicture;
use App\Entity\PortfolioSection;
use App\Entity\ServiceSection;
use App\Form\PortfolioPictureType;
use App\Form\PortfolioType;
use App\Form\ServiceSectionType;
use App\Repository\PortfolioPictureRepository;
use App\Repository\PortfolioSectionRepository;
use App\Repository\ServiceSectionRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/portfolio", name="backoffice_portfolio_")
 * @IsGranted("ROLE_ADMIN")
 */
class PortfolioController extends AbstractController
{
    /**
     * @Route("", name="index")
     */
    public function index(
        PortfolioSectionRepository $sectionRepository
    ): Response
    {
        $lastPorfolio = $sectionRepository->findOneBy([], ["id" => "DESC"]);

        return $this->render("backoffice/portfolio/index.html.twig", [
            "lastPortofolio"    => $lastPorfolio
        ]);
    }

    /**
     * @Route("/add", name="add")
     */
    public function add(
        PortfolioSectionRepository $serviceRepository,
        Request $request,
        EntityManagerInterface $manager
    ): Response
    {
        $section = $serviceRepository->findOneBy([], ["id" => "DESC"]) ?? new PortfolioSection();
        $form = $this->createForm(PortfolioType::class, $section);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){
            $manager->persist($section);
            $manager->flush();
            return $this->redirectToRoute("backoffice_portfolio_index");
        }

        return $this->render('backoffice/portfolio/add.html.twig', [
            "form"      => $form->createView(),
            "about"     => $section
        ]);
    }


    /**
     * @Route("/picture/add", name="picture_add")
     */
    public function addPicture(
        PortfolioSectionRepository $serviceRepository,
        Request $request,
        EntityManagerInterface $manager,
        FileUploader $fileUploader
    ): Response
    {
        $section = $serviceRepository->findOneBy([], ["id" => "DESC"]) ?? new PortfolioSection();
        $picture = new PortfolioPicture();
        $section->addPicture($picture);
        $form = $this->createForm(PortfolioPictureType::class, $picture);
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){
            $file = $form->get("picture")->getData();
            $manager->persist($section);
            $fileUploader->attachFile( $picture, $file);
            return $this->redirectToRoute("backoffice_portfolio_index");
        }

        return $this->render('backoffice/portfolio/add_picture.html.twig', [
            "form"      => $form->createView(),
        ]);
    }

    /**
     * @Route("/picture/{id}/delete", name="picture_delete")
     */
    public function deletePicture(
        PortfolioPicture $picture,
        Request $request,
        EntityManagerInterface $manager,
        FileUploader $fileUploader
    ): Response
    {
        $fileUploader->detachFile( $picture);
        $manager->remove($picture);
        $manager->flush();
        return $this->redirectToRoute("backoffice_portfolio_index");
    }
}
