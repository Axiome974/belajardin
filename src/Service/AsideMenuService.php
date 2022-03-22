<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AsideMenuService{

    const ELEMENTS = [
        "Accueil"   => "backoffice_main",
        "Carousel"  => "backoffice_carousel_index",
        "A propos"  => "backoffice_about_index",
        "Nos services"  => "backoffice_services_index",
        "Galerie"  => "backoffice_portfolio_index"
    ];
    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;
    /**
     * @var Request
     */
    private $request;

    /**
     * @param UrlGeneratorInterface $urlGenerator
     * @param RequestStack $request
     */
    public function __construct( UrlGeneratorInterface $urlGenerator, RequestStack $request)
    {
        $this->urlGenerator = $urlGenerator;
        $this->request = $request;
    }

    public function getRender(){

        $activeRoute = $this->request->getCurrentRequest()->get("_route");
        $html = "";


        foreach ( self::ELEMENTS as $label => $link ){

            $activeClass = (  (str_contains($link, $activeRoute) )? "active" : "text-white" );

            if( $link === "" || $link === "#"){
                $route = "#";
            }else{
                $route = $this->urlGenerator->generate($link);
            }
            $html .= "
                <li class='nav-item'>
                    <a href='${route}' class='nav-link ${activeClass}' aria-current='page'>
                    <svg class='bi me-2' width='16' height='16'><use xlink:href='${route}'></use></svg>
                     ${label}
                    </a>
                </li>
            ";
        }
        return $html;
    }

}
