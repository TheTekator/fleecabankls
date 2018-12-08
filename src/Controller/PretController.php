<?php

namespace App\Controller;

use App\Entity\Pret;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PretController extends AbstractController
{
    /**
     * @Route("/pret/{id}", name="show_pret")
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
