<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Epargne;
use App\Form\EpargneType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EpargneController extends AbstractController
{
    /**
     * @Route("/epargne/{id}", name="show_epargne", requirements={"id"="\d+"})
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showEpargne($id)
    {
        $em = $this->getDoctrine()->getManager();
        $monEpargne = $em->getRepository(Epargne::class)->find($id);

        return $this->render('Epargne/show.html.twig',
            array('monEpargne' => $monEpargne));
    }

    /**
     * @Route("/client/{id}/epargne/add", name="add_epargne", requirements={"id"="\d+"})
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function addEpargne(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $monEpargne = new Epargne();
        $monEpargne->setClient($em->getRepository(Client::class)->find($id));
        $monFormulaire = $this->createForm(EpargneType::class, $monEpargne);
        $monFormulaire->handleRequest($request);

        if($monFormulaire->isSubmitted() && $monFormulaire->isValid())
        {
            $em->persist($monEpargne);
            $em->flush();

            $this->addFlash('success', 'Epargne correctement ajoutée.');

            return $this->redirectToRoute('show_epargne',
                array('id' => $monEpargne->getId()));
        }

        return $this->render('Epargne/add.html.twig',
            array('monFormulaire' => $monFormulaire->createView()));
    }

    /**
     * @Route("/epargne/{id}/edit", name="edit_epargne", requirements={"id"="\d+"})
     */
    public function editPret(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $monEpargne = $em->getRepository(Epargne::class)->find($id);
        $monFormulaire =  $this->createForm(EpargneType::class, $monEpargne);
        $monFormulaire->handleRequest($request);

        if($monFormulaire->isSubmitted() && $monFormulaire->isValid())
        {
            $em->flush();

            $this->addFlash('success', 'Epargne correctement modifiée.');

            return $this->redirectToRoute('show_epargne',
                array('id' => $monEpargne->getId()));
        }

        return $this->render('Epargne/edit.html.twig',
            array('monFormulaire' => $monFormulaire->createView()));
    }

    /**
     * @Route("/epargnes", name="list_epargnes")
     */
    public function listEpargnes()
    {
        $em = $this->getDoctrine()->getManager();
        $mesEpargnes = $em->getRepository(Epargne::class)->findAll();

        return $this->render('Epargne/list.html.twig',
            array('mesEpargnes' => $mesEpargnes));
    }

    /**
     * @Route("/epargnes/encours", name="list_epargnesEnCours")
     */
    public function listEpargnesEnCours()
    {
        $em = $this->getDoctrine()->getManager();
        $mesEpargnesTmp = $em->getRepository(Epargne::class)->findAll();
        $mesEpargnes = [];

        foreach($mesEpargnesTmp as $monEpargne)
        {
            if(!$monEpargne->getFinished()) $mesEpargnes[] = $monEpargne;
        }

        return $this->render('Epargne/list.html.twig',
            array('mesEpargnes' => $mesEpargnes));
    }

    /**
     * @Route("/epargnes/cloturees", name="list_epargnesCloturees")
     */
    public function listEpargnesCloturees()
    {
        $em = $this->getDoctrine()->getManager();
        $mesEpargnesTmp = $em->getRepository(Epargne::class)->findAll();
        $mesEpargnes = [];

        foreach($mesEpargnesTmp as $monEpargne)
        {
            if($monEpargne->getFinished()) $mesEpargnes[] = $monEpargne;
        }

        return $this->render('Epargne/list.html.twig',
            array('mesEpargnes' => $mesEpargnes));
    }
}
