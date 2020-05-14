<?php
// src/Controller/AdvertController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/advert")
 */
class AdvertController extends AbstractController
{
    /**
     * @Route("/{page}", name="oc_advert_index", requirements={"page" = "\d+"}, defaults={"page" = 1})
     */
    public function index($page)
    {
        // On ne sait pas combien de pages il y a
        // Mais on sait qu'une page doit être supérieure ou égale à 1
        if ($page < 1) {
            // On déclenche une exception NotFoundHttpException, cela va afficher
            // une page d'erreur 404 (qu'on pourra personnaliser plus tard d'ailleurs)
            throw $this->createNotFoundException('Page "'.$page.'" inexistante.');
        }

        // Ici, on récupérera la liste des annonces, puis on la passera au template

        // Mais pour l'instant, on ne fait qu'appeler le template
        return $this->render('Advert/index.html.twig', ['name'=>'Marine']);
    }

    /**
     * @Route("/view/{id}", name="oc_advert_view", requirements={"id" = "\d+"})
     */
    public function view($id)
    {
        // Ici, on récupérera l'annonce correspondante à l'id $id

        return $this->render('Advert/view.html.twig', [
            'id' => $id,
        ]);
    }

    /**
     * @Route("/add", name="oc_advert_add")
     */
    public function add(Request $request)
    {
        // La gestion d'un formulaire est particulière, mais l'idée est la suivante :

        // Si la requête est en POST, c'est que le visiteur a soumis le formulaire
        if ($request->isMethod('POST')) {
            // Ici, on s'occupera de la création et de la gestion du formulaire

            $this->addFlash('notice', 'Annonce bien enregistrée.');

            // Puis on redirige vers la page de visualisation de cettte annonce
            return $this->redirectToRoute('oc_advert_view', ['id' => 5]);
        }

        // Si on n'est pas en POST, alors on affiche le formulaire
        return $this->render('Advert/add.html.twig');
    }

    /**
     * @Route("/edit/{id}", name="oc_advert_edit", requirements={"id" = "\d+"})
     */
    public function edit($id, Request $request)
    {
        // Ici, on récupérera l'annonce correspondante à $id

        // Même mécanisme que pour l'ajout
        if ($request->isMethod('POST')) {
            $this->addFlash('notice', 'Annonce bien modifiée.');

            return $this->redirectToRoute('oc_advert_view', ['id' => 5]);
        }

        return $this->render('Advert/edit.html.twig');
    }

    /**
     * @Route("/delete/{id}", name="oc_advert_delete", requirements={"id" = "\d+"})
     */
    public function delete($id)
    {
        // Ici, on récupérera l'annonce correspondant à $id

        // Ici, on gérera la suppression de l'annonce en question

        return $this->render('Advert/delete.html.twig');
    }
}
