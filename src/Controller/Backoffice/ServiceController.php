<?php

namespace App\Controller\Backoffice;

use App\Entity\AboutSection;
use App\Entity\IconSection;
use App\Entity\ServiceSection;
use App\Form\AboutSectionType;
use App\Form\IconSectionType;
use App\Form\ServiceSectionType;
use App\Repository\AboutSectionRepository;
use App\Repository\ServiceSectionRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/services", name="backoffice_services_")
 */
class ServiceController extends AbstractController
{
    /**
     * @Route("", name="index")
     */
    public function index(ServiceSectionRepository $serviceSectionRepository): Response
    {
        return $this->render('backoffice/services/index.html.twig', [
            "lastService"     => $serviceSectionRepository->findOneBy([], ["id" => "DESC"])
        ]);
    }


    /**
     * @Route("/add", name="add")
     */
    public function add(
        ServiceSectionRepository $serviceRepository,
        Request $request,
        EntityManagerInterface $manager
    ): Response
    {
        $section = $serviceRepository->findOneBy([], ["id" => "DESC"]) ?? new ServiceSection();
        $form = $this->createForm(ServiceSectionType::class, $section);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){
            $manager->persist($section);
            $manager->flush();
            return $this->redirectToRoute("backoffice_services_index");
        }

        return $this->render('backoffice/services/add.html.twig', [
            "form"      => $form->createView(),
            "about"     => $section
        ]);
    }

    /**
     * @param ServiceSection $section
     * @param EntityManagerInterface $manager
     * @param Request $request
     * @return Response
     * @Route("/{id}/iconsection/add", name="icsection_add")
     */
    public function addIconSection(
        ServiceSection $section,
        EntityManagerInterface $manager,
        Request $request
    ){
        $iconPack = new IconSection();
        $section->addIconSection( $iconPack );

        $form = $this->createForm(IconSectionType::class, $iconPack);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){
            $manager->persist($section);
            $manager->flush();
            return $this->redirectToRoute("backoffice_services_index", [
                "id"        => $section->getId()
            ]);
        }
        return $this->render("backoffice/icon_section/add.html.twig", [
            "form"  => $form->createView()
        ]);
    }


    /**
     * @Route("/{id}/remove/picture", name="remove_picture")
     * @param AboutSection $aboutSection
     * @param FileUploader $fileUploader
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
