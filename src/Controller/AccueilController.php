<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController{

    function afficher($name) {
        return $this->render('/accueil/accueil.html.twig', array('name' => $name));
    }
}


?>