<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


/**
 * Class DeelnemerController
 * @package App\Controller
 * @Route("/deelnemer")
 */
class DeelnemerController extends AbstractController
{
    /**
     * @Route("/activiteiten", name="activiteiten")
     */
    public function activiteitenAction(): Response
    {
        $user= $this->getUser();

        $beschikbareActiviteiten=$this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->getBeschikbareActiviteiten($user->getId());

        $ingeschrevenActiviteiten=$this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->getIngeschrevenActiviteiten($user->getId());

        $totaal=$this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->getTotaal($ingeschrevenActiviteiten);


        return $this->render('deelnemer/activiteiten.html.twig', [
            'beschikbare_activiteiten'=>$beschikbareActiviteiten,
            'ingeschreven_activiteiten'=>$ingeschrevenActiviteiten,
            'totaal'=>$totaal,
        ]);
    }

    /**
     * @param $id
     * @Route("/inschrijven/{id}", name="inschrijven")
     */
    public function inschrijvenActiviteitAction($id)
    {
        $activiteit = $this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->find($id);
        $user= $this->getUser();
        $user->addActiviteiten($activiteit);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->redirectToRoute('activiteiten');
    }

    /**
     * @Route("/user/uitschrijven/{id}", name="uitschrijven")
     */
    public function uitschrijvenActiviteitAction($id)
    {
        $activiteit = $this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->find($id);
        $user= $this->getUser();
        $user->removeActiviteiten($activiteit);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        return $this->redirectToRoute('activiteiten');
    }

    /**
     * @Route("/account", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request,  UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $gebruiker = $form->getData();
            $gebruiker->setPassword($passwordEncoder->encodePassword($gebruiker, $gebruiker->getPassword()));
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('activiteiten');
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
