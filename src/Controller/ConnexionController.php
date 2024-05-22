<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ConnexionController extends AbstractController
{
    /**
     * @Route("/connexion", name="connexion")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // affiche une éventuelle erreur 
        $error = $authenticationUtils->getLastAuthenticationError();
        // récupère le dernier nom d'utilisateur utilisé
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('connexion/connexion.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }
}

