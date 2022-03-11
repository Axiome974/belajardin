<?php

namespace App\Controller\Backoffice;

use App\Entity\AboutSection;
use App\Entity\IconSection;
use App\Form\AboutSectionType;
use App\Form\IconSectionType;
use App\Repository\AboutSectionRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/about", name="backoffice_about_")
 */
class AboutController extends AbstractController
{
    /**
     * @Route("", name="index")
     */
    public function index(AboutSectionRepository $aboutSectionRepository): Response
    {
        return $this->render('backoffice/about/index.html.twig', [
            "lastAbout"     => $aboutSectionRepository->findOneBy([], ["id" => "DESC"])
        ]);
    }


    /**
     * @Route("/add", name="add")
     */
    public function add(
        AboutSectionRepository $aboutSectionRepository,
        FileUploader $fileUploader,
        Request $request
    ): Response
    {
        $section = $aboutSectionRepository->findOneBy([], ["id" => "DESC"]) ?? new AboutSection();
        $form = $this->createForm(AboutSectionType::class, $section);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){
            $file = $form->get('file')->getData();
            $fileUploader->attachFile($section, $file);
            return $this->redirectToRoute("backoffice_about_index");
        }

        return $this->render('backoffice/about/add.html.twig', [
            "form"      => $form->createView(),
            "about"     => $section
        ]);
    }

    /**
     * @param AboutSection $aboutSection
     * @param EntityManagerInterface $manager
     * @param Request $request
     * @return Response
     * @Route("/{id}/iconsection/add", name="icsection_add")
     */
    public function addIconSection(
        AboutSection $aboutSection,
        EntityManagerInterface $manager,
        Request $request
    ){
        $iconPack = new IconSection();
        $aboutSection->addIconSection( $iconPack );

        $form = $this->createForm(IconSectionType::class, $iconPack);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){
            $manager->persist($aboutSection);
            $manager->flush();
            return $this->redirectToRoute("backoffice_about_index", [
                "id"        => $aboutSection->getId()
            ]);
        }
        return $this->render("backoffice/icon_section/add.html.twig", [
            "form"  => $form->createView()
        ]);
    }


    /**
     * @Route("/{id}/remove/picture", name="remove_picture")
     * @return RedirectResponse
     */
    public function detachFile(
        AboutSection $aboutSection,
        FileUploader $fileUploader
    ): RedirectResponse
    {
        $fileUploader->detachFile($aboutSection);
        return $this->redirectToRoute("backoffice_about_add", [
            "id"    => $aboutSection->getId()
        ]);
    }
}
