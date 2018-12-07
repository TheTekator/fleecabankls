<?php

namespace App\Controller;

use App\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    /**
     * @Route("/clients", name="list_clients")
     */
    public function list()
    {
        $em = $this->getDoctrine()->getManager();
        $mesClients = $em->getRepository(Client::class)->findAll();

        return $this->render('Client/list.html.twig',
                    array('mesClients' => $mesClients));
    }

    /**
     * @Route("/client/{id}", name="show_client")
     * @param $id Identifiant du client
     * @return Response Affichage de la page du client
     */
    public function show($id)
    {
        $em = $this->getDoctrine()->getManager();
        $monClient = $em->getRepository(Client::class)->find($id);

        return $this->render('Client/show.html.twig',
                    array('monClient' => $monClient));
    }
}
