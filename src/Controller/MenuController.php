<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MenuController extends AbstractController{
    function afficher(){
        return $this->render('menu/menu.html.twig');
    }
}
?>

