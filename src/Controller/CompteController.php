<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Compte;
use App\Form\CompteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompteController extends AbstractController
{
    /**
     * @Route("/compte/add/{id}", name="add_compte", requirements={"id"="\d+"})
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function addCompte(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $monCompte = new Compte();
        $monCompte->setClient($em->getRepository(Client::class)->find($id));
        $monFormulaire = $this->createForm(CompteType::class, $monCompte);
        $monFormulaire->handleRequest($request);

        if($monFormulaire->isSubmitted() && $monFormulaire->isValid())
        {
            $em->persist($monCompte);
            $em->flush();

            $this->addFlash('success', 'Compte correctement ajouté.');

            return $this->redirectToRoute('show_compte',
                array('id' => $monCompte->getId()));
        }

        return $this->render('Compte/add.html.twig',
            array('monFormulaire' => $monFormulaire->createView()));
    }

    /**
     * @Route("/compte/edit/{id}", name="edit_compte", requirements={"id"="\d+"})
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function editCompte(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $monCompte = $em->getRepository(Compte::class)->find($id);
        $monFormulaire = $this->createForm(CompteType::class, $monCompte);
        $monFormulaire->handleRequest($request);

        if($monFormulaire->isSubmitted() && $monFormulaire->isValid())
        {
            $em->flush();
            $this->addFlash('succes', 'Compte correctement modifié.');

            return $this->redirectToRoute('show_compte',
                array('id' => $monCompte->getId()));
        }

        return $this->render('Compte/edit.html.twig',
            array('monFormulaire' => $monFormulaire->createView()));
    }

    /**
     * @Route("/compte/{id}", name="show_compte", requirements={"id"="\d+"})
     * @param $id
     * @return Response
     */
    public function showCompte($id)
    {
        $em = $this->getDoctrine()->getManager();
        $monCompte = $em->getRepository(Compte::class)->find($id);

        return $this->render('Compte/show.html.twig',
            array('monCompte' => $monCompte));
    }
}
