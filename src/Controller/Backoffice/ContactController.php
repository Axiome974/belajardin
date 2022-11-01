<?php

namespace App\Controller\Backoffice;

use App\Entity\Contact;
use App\Entity\ServiceSection;
use App\Form\ContactType;
use App\Form\ServiceSectionType;
use App\Repository\ContactRepository;
use App\Repository\ServiceSectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route('/backoffice/contact', name: 'backoffice_contact_')]
#[IsGranted('ROLE_ADMIN')]
class ContactController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ContactRepository $contactRepository): Response
    {
        return $this->render('backoffice/contact/index.html.twig', [
            "lastContact" => $contactRepository->findOneBy([], ["id" => "DESC"])
        ]);
    }

    #[Route('/add', name: 'add')]
    public function add(
        ContactRepository $contactRepository,
        Request $request,
        EntityManagerInterface $manager
    ): Response
    {
        $section = $contactRepository->findOneBy([], ["id" => "DESC"]) ?? new Contact();
        $section->setTitle('Contactez-nous!');

        $form = $this->createForm(ContactType::class, $section);

        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ){
            $manager->persist($section);
            $manager->flush();
            return $this->redirectToRoute("backoffice_contact_index");
        }

        return $this->render('backoffice/contact/add.html.twig', [
            "form"      => $form->createView(),
        ]);
    }

    #[Route('/delete', name: 'delete')]
    public function delete(
        ContactRepository $contactRepository,
        EntityManagerInterface$entityManager
    ): RedirectResponse
    {
        $lastContact = $contactRepository->findOneBy([], ["id" => "DESC"]);
        $entityManager->remove($lastContact);
        $entityManager->flush();
        return $this->redirectToRoute('backoffice_contact_index');
    }

}
