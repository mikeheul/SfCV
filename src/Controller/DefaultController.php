<?php

namespace App\Controller;

use App\Entity\Experience;
use App\Entity\Personne;
use App\Form\PersonneType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    /**
     * @Route("/home", name="homepage")
     */
    public function index(Request $request): Response
    {
        $personne = new Personne();
        $personne->setNom("MURMANN");
        $personne->setPrenom("Micka");
        $personne->setDateNaissance(new \DateTime("1985-01-17"));
        $personne->setIntituleCV("Formateur numérique");
        $personne->setEmail("micka@exemple.com");
        $personne->setTelephone("06778855");
        $personne->setAdresse("10 route de la Gare");
        $personne->setCp("67000");
        $personne->setVille("STRASBOURG");

        $exp = new Experience();
        $exp->setTitre("Formateur (ELAN FORMATION)");
        $exp->setVille("Strasbourg");
        $exp->setDateDebut(new \DateTime("2010-02-01"));
        $exp->setDateFin(new \DateTime());
        $exp->setPersonne($personne);

        $personne->addExperience($exp);

        $form = $this->createForm(PersonneType::class, $personne);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            dump($personne);
        }

        return $this->render('default/index.html.twig', [
            'formPersonne' => $form->createView(),
            'personne' => $personne
        ]);
    }
}
