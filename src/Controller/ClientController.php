<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/clients", name="list_clients")
     */
    public function listClients()
    {
        $em = $this->getDoctrine()->getManager();
        $mesClients = $em->getRepository(Client::class)->findAll();

        return $this->render('Client/list.html.twig',
                    array('mesClients' => $mesClients));
    }

    /**
     * @Route("/client/add", name="add_client")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function addClient(Request $request)
    {
        $monClient = new Client();
        $monFormulaire = $this->createForm(ClientType::class, $monClient);
        $monFormulaire->handleRequest($request);

        if($monFormulaire->isSubmitted() && $monFormulaire->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($monClient);
            $em->flush();

            $this->addFlash('success', 'Client correctement ajouté.');

            return $this->redirectToRoute('show_client',
                array('id' => $monClient->getId()));
        }

        return $this->render('Client/add.html.twig',
            array('monFormulaire' => $monFormulaire->createView()));
    }

    /**
     * @Route("/client/edit/{id}", name="edit_client", requirements={"id"="\d+"})
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function editClient(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $monClient = $em->getRepository(Client::class)->find($id);

        $monFormulaire = $this->createForm(ClientType::class, $monClient);
        $monFormulaire->handleRequest($request);

        if($monFormulaire->isSubmitted() && $monFormulaire->isValid())
        {
            $em->persist($monClient);
            $em->flush();

            $this->addFlash('success', 'Client correctement modifié.');

            return $this->redirectToRoute('show_client',
                array('id' => $monClient->getId()));
        }

        return $this->render('Client/edit.html.twig',
            array('monFormulaire' => $monFormulaire->createView()));
    }

    /**
     * @Route("/client/{id}", name="show_client", requirements={"id"="\d+"})
     * @param int $id Identifiant du client
     * @return Response Affichage de la page du client
     */
    public function showClient($id)
    {
        $em = $this->getDoctrine()->getManager();
        $monClient = $em->getRepository(Client::class)->find($id);

        return $this->render('Client/show.html.twig',
            array('monClient' => $monClient));
    }
}
