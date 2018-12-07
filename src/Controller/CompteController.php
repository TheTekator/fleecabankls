<?php

namespace App\Controller;

use App\Entity\Compte;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompteController extends AbstractController
{
    /**
     * @Route("/compte/{id}", name="show_compte")
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $em = $this->getDoctrine()->getManager();
        $monCompte = $em->getRepository(Compte::class)->find($id);

        return $this->render('Compte/show.html.twig',
            array('monCompte' => $monCompte));
    }
}
