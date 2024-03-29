<?php

namespace App\Controller\Backoffice;

use App\Entity\AboutSection;
use App\Entity\IconSection;
use App\Form\AboutSectionType;
use App\Form\IconSectionType;
use App\Repository\AboutSectionRepository;
use App\Repository\IconSectionRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/backoffice/icsection", name:"backoffice_iconsection_")]
#[IsGranted('ROLE_ADMIN')]
class IconSectionController extends AbstractController
{

    /**
     * @Route("/add", name="add")
     */
    public function add(
        Request $request,
        EntityManagerInterface $manager
    ): Response
    {
        $iconPack = new IconSection();
        $form = $this->createForm(IconSectionType::class, $iconPack);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){
            $manager->persist($iconPack);
            $manager->flush();
        }

        return $this->render('backoffice/icon_section/add.html.twig', [
            "form"      => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/update", name="update")
     */
    public function update(
        Request $request,
        IconSection $iconPack,
        EntityManagerInterface $manager
    ): Response
    {
        $form = $this->createForm(IconSectionType::class, $iconPack);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){
            $manager->persist($iconPack);
            $manager->flush();
            return $this->redirectToRoute('backoffice_services_index');
        }

        return $this->render('backoffice/icon_section/add.html.twig', [
            "form"      => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/delete", name="delete")
     */
    public function delete(
        Request $request,
        IconSection $iconSection,
        EntityManagerInterface $manager
    ): RedirectResponse
    {
        $manager->remove($iconSection);
        $manager->flush();
        return $this->redirectToRoute('backoffice_services_index');
    }




}
