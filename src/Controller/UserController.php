<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\User1Type;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserController
 * @package App\Controller
 * @Route("/admin/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        $activiteiten=$this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->findAll();

        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
            'activiteiten' => $activiteiten,
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        $activiteiten=$this->getDoctrine()
            ->getRepository('App:Activiteit')
            ->findAll();

        return $this->render('user/show.html.twig', [
            'user' => $user,
            'activiteiten' => $activiteiten,
        ]);
    }

    /**
     * @Route("/{id}/resetpassword", name="user_reset_password", methods={"GET"})
     */
    public function resetUserPasswordAction($id, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $rep = $this->getDoctrine()->getRepository('App:User');
        $user = $rep->find($id);
        $encodedPassword = $passwordEncoder->encodePassword(
            $user,
            "qwerty"
        );
        $rep->upgradePassword($user, $encodedPassword);

        return $this->redirectToRoute('user_index');
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"POST"})
     */
    public function delete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_index');
    }
}
