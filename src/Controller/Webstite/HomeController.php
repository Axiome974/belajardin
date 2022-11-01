<?php

namespace App\Controller\Webstite;

use App\Entity\VisitorMessage;
use App\Form\VisitorMessageType;
use App\Repository\AboutSectionRepository;
use App\Repository\ContactRepository;
use App\Repository\DiapositiveRepository;
use App\Repository\PortfolioSectionRepository;
use App\Repository\ServiceSectionRepository;
use App\Repository\VisitorMessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\DocBlock\Tags\Return_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        $messageForm = $this->createForm(VisitorMessageType::class,new VisitorMessage(), [
            'action' => $this->generateUrl('home_post_visitor_message'),
            'attr'   => [
                'class'             => 'php-email-form',
//                'data-controller'   => 'contact'
            ]
        ]);
        return $this->render('webstite/home/index.html.twig', [
            "diapositives"      => $diapositiveRepository->findAll(),
            "about"             => $aboutSectionRepository->findOneBy([], ["id" => "DESC"]),
            "service"           => $serviceSectionRepository->findOneBy([], ["id" => "DESC"]),
            "portfolio"         => $portfolioSectionRepository->findOneBy([], ["id" => "DESC"]),
            "contact"           => $contactRepository->findOneBy([], ["id" => "DESC"]),
            'messageForm'       => $messageForm->createView()
        ]);
    }

    #[Route('/visitor_message', name: 'post_visitor_message', methods: 'post')]
    public function postContactForm(Request $request, EntityManagerInterface $manager): Response
    {
        $visitMessage = new VisitorMessage();
        $messageForm = $this->createForm(VisitorMessageType::class,$visitMessage, [
            'action' => $this->generateUrl('home_post_visitor_message'),
            'attr'   => [
                'class'             => 'php-email-form',
//                'data-controller'   => 'contact'
            ]
        ]);
        $messageForm->handleRequest($request);
        if( $messageForm ->isSubmitted() && $messageForm->isValid() ){
            $manager->persist($visitMessage);
            $manager->flush();
            return new Response("Envoyé!", Response::HTTP_OK);
        }
        return new Response("Erreur d'envoi", Response::HTTP_INTERNAL_SERVER_ERROR);

    }


}
