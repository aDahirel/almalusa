<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RegistrationType;
use App\Form\ModificationType;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Entity\User;
use Twig\Environment;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, ManagerRegistry $managerRegistry, UserPasswordEncoderInterface $encoder)
    {
        // Create a use entity
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);
        // Process the data
        $form->handleRequest($request);

        // If the submit button is pushed and the form is valid
        if ($form->isSubmitted() && $form->isValid()) {
            // Crypt the passwords
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);

            // Create the user
            $em = $managerRegistry->getManager();
            $em->persist($user);
            $em->flush();

            // Return to the login page
            return $this->redirectToRoute('security_login');
        }
        // Return the inscription page
        return $this->render('blog/registration.html.twig', [
            'form' => $form->createview()
        ]);
    }

    /**
     * @Route("/connexion", name="security_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('blog/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     * @Route("/profil", name="user_profil")
     */
    public function profil(Request $request, ManagerRegistry $managerRegistry, UserPasswordEncoderInterface $encoder)
    {
        // allow any authenticated user - we don't care if they just
        // logged in, or are logged in via a remember me cookie
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');

        $user = $this->getUser();

        $form = $this->createForm(ModificationType::class, $user);

        $form->handleRequest($request);

        // If the submit button is pushed and the form is valid
        if ($form->isSubmitted() && $form->isValid()) {

            // Create the user
            $em = $managerRegistry->getManager();
            $em->persist($user);
            $em->flush();

            // Return to the login page

            $this->addFlash('success', 'Vous avez mis a jour votre profil !' );
            return $this->redirectToRoute('security_login');
        }

        return $this->render('user/user.html.twig', [
            'user' => $user,
            'form' => $form->createview()
        ]);
    }

    /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout()
    {
    }

    /**
     * @Route("{id}/delete_user", name="delete_user", methods="DELETE")
     */
    public function delete_user(User $user, Request $request, ManagerRegistry $managerRegistry)
    {
        $em = $managerRegistry->getManager();
        $em->remove($user);
        $em->flush();
        $session = new Session();
        $session->invalidate();
        return $this->redirectToRoute('security_logout');
    }
/*
    /**
     * @Route("/forgotten_password", name="app_forgotten_password")

    public function forgottenPassword(Request $request, UserPasswordEncoderInterface $encoder, \Swift_Mailer $mailer, TokenGeneratorInterface $tokenGenerator, Environment $renderer): Response
    {

        if ($request->isMethod('POST')) {

            $email = $request->request->get('email');

            $entityManager = $this->getDoctrine()->getManager();
            $user = $entityManager->getRepository(User::class)->findOneByEmail($email);
            /* @var $user User

            if ($user === null) {
                $this->addFlash('danger', 'Email Inconnu'); // notice doesnt work
                return $this->redirectToRoute('home');
            }
            $token = $tokenGenerator->generateToken();

            try {
                $user->setResetToken($token);
                $entityManager->flush();
            } catch (\Exception $e) {
                $this->addFlash('warning', $e->getMessage());
                return $this->redirectToRoute('home');
            }

            $url = $this->generateUrl('app_reset_password', array('token' => $token), UrlGeneratorInterface::ABSOLUTE_URL);
            $message = (new \Swift_Message('Forgot Password'))
                ->setFrom('noreply@almalusa.com') //insert mail
                ->setTo($user->getEmail())
                ->setBody($renderer->render('emails/forget.html.twig', [ // body de l'email a écrire
                    'contact' => $user->getUsername(),
                ]), 'text/html');
            $mailer->send($message); //erreur au niveau de l'envoi du au port 25


            $this->addFlash('notice', 'Mail envoyé');

            return $this->redirectToRoute('home');
        }

        return $this->render('admin/forgotten_password.html.twig');
    }
*/


    /**
     * @Route("/reset_password/{token}", name="app_reset_password")
     */
    public function resetPassword(Request $request, string $token, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        if ($request->isMethod('POST')) {
            $entityManager = $this->getDoctrine()->getManager();

            $user = $entityManager->getRepository(User::class)->findOneByResetToken($token);
            /* @var $user User */

            if ($user === null) {
                $this->addFlash('danger', 'Token Inconnu');
                return $this->redirectToRoute('home');
            }

            $user->setResetToken(null);
            if ($request->request->get('password') === $request->request->get('password2')){
                $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
                $entityManager->flush();
                $this->addFlash('success', 'Mot de passe mis à jour');
            }   
            else{
                return $this->render('admin/reset_password.html.twig', ['token' => $token]);
            }
            return $this->redirectToRoute('home');
        } else {
            return $this->render('admin/reset_password.html.twig', ['token' => $token]);
        }
    }

}
