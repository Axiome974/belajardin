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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/backoffice/icsection", name="backoffice_iconsection_")
 */
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


}
