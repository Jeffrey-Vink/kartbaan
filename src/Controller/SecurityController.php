<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils, Security $security): Response
    {
        if ($this->getUser()) {
            if ($security->isGranted('ROLE_ADMIN')) {
                return $this->redirectToRoute('activiteitenoverzicht');
            }
            if ($security->isGranted('ROLE_USER')) {
                return $this->redirectToRoute('activiteiten');
            }
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * @Route("registreren", name="registreren")
     */
    public function registreren(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $form = $this->createForm(UserType::class);
        $form->add('save', SubmitType::class, array('label'=>"registreren"));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $user->setRoles(["ROLE_USER"]);
            $pass = $form->getData()->getPassword();
            $user->setPassword($passwordEncoder->encodePassword(
                $user,
                $pass
            ));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->render('bezoeker/nieuwSA.html.twig');
        }
        return $this->render('security/registreren.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
