<?php

namespace App\Controller;

use App\Entity\Soortactiviteit;
use App\Form\ActiviteitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class BezoekerController
 * @package App\Controller
 */
class BezoekerController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('bezoeker/index.html.twig',array('boodschap'=>'Welkom'));
    }

    /**
     * @Route("/kartactiviteiten", name="kartactiviteiten")
     */
    public function kartactiviteitenAction()
    {
        $repository=$this->getDoctrine()->getRepository(Soortactiviteit::class);
        $soortactiviteiten=$repository->findAll();
        return $this->render('bezoeker/kartactiviteiten.html.twig', [
            'soortactiviteiten' => $soortactiviteiten,
        ]);
    }
}
