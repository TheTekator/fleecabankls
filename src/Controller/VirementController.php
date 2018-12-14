<?php

namespace App\Controller;

use App\Entity\Pret;
use App\Entity\Virement;
use App\Form\VirementType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VirementController extends AbstractController
{
    /**
     * @Route("/virement/{id}", name="show_virement", requirements={"id"="\d+"})
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showVirement($id)
    {
        $em = $this->getDoctrine()->getManager();
        $monVirement = $em->getRepository(Virement::class)->find($id);

        return $this->render('Virement/show.html.twig',
            array('monVirement' => $monVirement));
    }

    /**
     * @Route("/pret/{id}/virement/add", name="add_virement_to_pret", requirements={"id"="\d+"})
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addVirementToPret(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $monVirement = new Virement();
        $monVirement->setPret($em->getRepository(Pret::class)->find($id));
        $monFormulaire = $this->createForm(VirementType::class, $monVirement);
        $monFormulaire->handleRequest($request);

        if($monFormulaire->isSubmitted() && $monFormulaire->isValid())
        {
            $em->persist($monVirement);
            $em->flush();

            $this->addFlash('success', 'Virement correctement ajouté.');

            return $this->redirectToRoute('show_pret', array('id' => $monVirement->getPret()->getId()));
        }

        return $this->render('Virement/add.html.twig',
            array('monFormulaire' => $monFormulaire->createView()));
    }

    /**
     * @Route("/virement/{id}/edit", name="edit_virement", requirements={"id"="\d+"})
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function editVirementFromPret(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $monVirement = $em->getRepository(Virement::class)->find($id);
        $monFormulaire = $this->createForm(VirementType::class, $monVirement);
        $monFormulaire->handleRequest($request);

        if($monFormulaire->isSubmitted() && $monFormulaire->isValid())
        {
            $em->flush();

            $this->addFlash('success', 'Virement correctement modifié.');

            return $this->redirectToRoute('show_pret', array('id' => $monVirement->getPret()->getId()));
        }

        return $this->render('Virement/edit.html.twig',
            array('monFormulaire' => $monFormulaire->createView()));
    }
}
