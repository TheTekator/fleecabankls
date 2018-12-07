<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EpargneController extends AbstractController
{
    /**
     * @Route("/Epargne", name="Epargne")
     */
    public function index()
    {
        return $this->render('epargne/index.html.twig', [
            'controller_name' => 'EpargneController',
        ]);
    }
}
