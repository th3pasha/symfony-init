<?php
namespace App\Controller;
use App\Entity\Resto;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController{

    function afficher($name) {
        return $this->render('/accueil/accueil.html.twig', array('name' => $name));
    }

    function voir($id){
        $resto = $this->getDoctrine()->getRepository(Resto::class)->find($id);
        if (!$resto){
            throw $this->createNotFoundException('Salle[id='.$id.') inexsitant');
        }
        return $this->render('/accueil/voir.html.twig', array('resto' => $resto));
    }

    function ajouter($nom, $chef, $nbreEtoile){

        $entityManager = $this->getDoctrine()->getManager();
        $resto = new Resto();
        $resto->setNom($nom);
        $resto->setChef($chef);
        $resto->setNbreEtoile($nbreEtoile);

        $entityManager->persist($resto);
        $entityManager->flush();

        return $this->redirect('guide_michelin_voir', array('id' => $resto->getId()));

    }
}
?>