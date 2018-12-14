<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Pret;
use App\Form\PretType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PretController extends AbstractController
{
    /**
     * @Route("/pret/{id}", name="show_pret", requirements={"id"="\d+"})
     * @param $id
     * @return Response
     */
    public function showPret($id)
    {
        $em = $this->getDoctrine()->getManager();
        $monPret = $em->getRepository(Pret::class)->find($id);

        return $this->render('Pret/show.html.twig',
                        array('monPret' => $monPret));
    }

    /**
     * @Route("/client/{id}/pret/add", name="add_pret", requirements={"id"="\d+"})
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function addPret(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $monPret = new Pret();
        $monPret->setClient($em->getRepository(Client::class)->find($id));
        $monFormulaire = $this->createForm(PretType::class, $monPret);
        $monFormulaire->handleRequest($request);

        if($monFormulaire->isSubmitted() && $monFormulaire->isValid())
        {
            $em->persist($monPret);
            $em->flush();

            $this->addFlash('success', 'Prêt correctement ajouté.');

            return $this->redirectToRoute('show_pret',
                array('id' => $monPret->getId()));
        }

        return $this->render('Pret/add.html.twig',
            array('monFormulaire' => $monFormulaire->createView()));
    }

    /**
     * @Route("/pret/{id}/edit", name="edit_pret", requirements={"id"="\d+"})
     */
    public function editPret(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $monPret = $em->getRepository(Pret::class)->find($id);
        $monFormulaire =  $this->createForm(PretType::class, $monPret);
        $monFormulaire->handleRequest($request);

        if($monFormulaire->isSubmitted() && $monFormulaire->isValid())
        {
            $em->flush();

            $this->addFlash('success', 'Prêt correctement modifié.');

            return $this->redirectToRoute('show_pret',
                array('id' => $monPret->getId()));
        }

        return $this->render('Pret/edit.html.twig',
            array('monFormulaire' => $monFormulaire->createView()));
    }

    /**
     * @Route("/prets", name="list_prets")
     */
    public function listPrets()
    {
        $em = $this->getDoctrine()->getManager();
        $mesPrets = $em->getRepository(Pret::class)->findAll();

        return $this->render('Pret/list.html.twig',
                        array('mesPrets' => $mesPrets));
    }

    /**
     * @Route("/prets/retard", name="list_pretsLate")
     */
    public function listPretsRetard()
    {
        $em = $this->getDoctrine()->getManager();
        $mesPretsTmp = $em->getRepository(Pret::class)->findAll();
        $mesPrets = [];

        foreach($mesPretsTmp as $monPret)
        {
            if($monPret->isLate()) $mesPrets[] = $monPret;
        }

        return $this->render('Pret/list.html.twig',
            array('mesPrets' => $mesPrets));
    }

    /**
     * @Route("/prets/aujourdhui", name="list_pretsToday")
     */
    public function listPretsToday()
    {
        $em = $this->getDoctrine()->getManager();
        $mesPretsTmp = $em->getRepository(Pret::class)->findAll();
        $mesPrets = [];

        foreach($mesPretsTmp as $monPret)
        {
            if($monPret->isToday()) $mesPrets[] = $monPret;
        }

        return $this->render('Pret/list.html.twig',
            array('mesPrets' => $mesPrets));
    }

    /**
     * @Route("/prets/encours", name="list_pretsEnCours")
     */
    public function listPretsCours()
    {
        $em = $this->getDoctrine()->getManager();
        $mesPretsTmp = $em->getRepository(Pret::class)->findAll();
        $mesPrets = [];

        foreach($mesPretsTmp as $monPret)
        {
            if(!$monPret->getTermine()) $mesPrets[] = $monPret;
        }

        return $this->render('Pret/list.html.twig',
            array('mesPrets' => $mesPrets));
    }
}
