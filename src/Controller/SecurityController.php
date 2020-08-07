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
use App\Repository\UserRepository;
use Twig\Environment;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(Request $request, ManagerRegistry $managerRegistry, 
    UserPasswordEncoderInterface $encoder, \Swift_Mailer $mailer)
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

            // Generate the activation token
            $user->setActivationToken(md5(uniqid()));

            // Create the user
            $em = $managerRegistry->getManager();
            $em->persist($user);
            $em->flush();

            // Sending an email
            $message = (new \Swift_Message('Activation de votre compte'))
            // Expeditor
            ->setFrom('votre@adresse.fr')
            // Recipient
            ->setTo($user->getEmail())
            // Mail content
            ->setBody(
                $this->renderView(
                    'primary/user/activation.html.twig', ['token' => $user->getActivationToken()]
                ),
                'text/html'
            )
            ;
            // Sending mail
            $mailer->send($message);

            $this->addFlash('success', 'Vous avez créé votre profil');

            // Return to the login page
            return $this->redirectToRoute('security_login');
        }
        // Return the inscription page
        return $this->render('primary/user/connexion/registration.html.twig', [
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

        return $this->render('primary/user/connexion/connexion.html.twig', [
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

            $this->addFlash('success', 'Vous avez mis a jour votre profil !');
            return $this->redirectToRoute('security_login');
        }

        return $this->render('primary/user/user_modification.html.twig', [
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

    /**
     * @Route("activation/{token}", name="activation")
     */
    public function activation($token, UserRepository $user){

        // Veryfing if the un user has a token
        $user = $user->findOneBy(['activationToken' => $token]);

        // If no user exists with the token
        if(!$user){
            // Error 404
            throw $this->createNotFoundException('Cet utilisateur n\'existe pas');
        }

        // Deleting token
        $user->setActivationToken(null);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        // Sending flash message
        $this->addFlash('success', 'Vous avez  bien activé votre compte');

        // Returning to home page
        return $this->redirectToRoute('home');
    }

}
