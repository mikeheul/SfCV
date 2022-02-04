<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Form\PersonneType;
use App\Repository\PersonneRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PersonneController extends AbstractController
{
    /**
     * @Route("/", name="personne")
     */
    public function index(PersonneRepository $pr): Response
    {
        $personnes = $pr->findBy([], ["nom" => "ASC"]);

        return $this->render('personne/index.html.twig', [
            'personnes' => $personnes,
        ]);
    }

    /**
     * @Route("/personne/edit/{id}", name="personne_edit")
     * @Route("/personne/add", name="personne_add")
     */
    public function edit(ManagerRegistry $mr, Personne $personne = null, Request $request): Response
    {
        if(!$personne) {
            $personne = new Personne();
        }

        $form = $this->createForm(PersonneType::class, $personne);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            
            $personne = $form->getData();
            $mr->getManager()->persist($personne);
            $mr->getManager()->flush();

            return $this->redirectToRoute('personne_show', ["id" => $personne->getId()]);
        }

        return $this->render('personne/edit.html.twig', [
            'formPersonne' => $form->createView(),
            //'personne' => $personne
        ]);
    }

    /**
     * @Route("/personne/show/{id}", name="personne_show", requirements={"id"="\d+"})
     */
    public function show(Personne $personne): Response
    {
        return $this->render('personne/show.html.twig', [
            'personne' => $personne,
        ]);
    }
}
