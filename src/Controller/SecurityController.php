<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RegistrationType;
use App\Form\ModificationType;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

use App\Entity\User;
use App\Form\ResetPassType;
use App\Repository\UserRepository;
use App\Security\UserAuthenticator;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="security_registration")
     */
    public function registration(
        Request $request,
        ManagerRegistry $managerRegistry,
        UserPasswordEncoderInterface $encoder,
        \Swift_Mailer $mailer,
        GuardAuthenticatorHandler $guardHandler,
        UserAuthenticator $authenticator
    ) {
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
                        'primary/user/activation.html.twig',
                        ['token' => $user->getActivationToken()]
                    ),
                    'text/html'
                );

            // Sending mail
            $mailer->send($message);

            $this->addFlash('success', 'Vous avez créé votre profil');

            return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main'
            );

            // Return to the login page
            return $this->redirectToRoute('home');
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
    public function activation($token, UserRepository $user)
    {

        // Veryfing if the un user has a token
        $user = $user->findOneBy(['activationToken' => $token]);

        // If no user exists with the token
        if (!$user) {
            // Error 404
            throw $this->createNotFoundException('Cet utilisateur n\'existe pas');
        }

        // Deleting token
        $user->setActivationToken(null);

        $user->setRoles(array('ROLE_VERIFIED_USER'));

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        // Sending flash message
        $this->addFlash('success', 'Vous avez  bien activé votre compte');

        // Returning to home page
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/oubli-pass", name="forgotten_password")
     */
    public function forgottenPass(Request $request,UserRepository $userRepo,\Swift_Mailer $mailer,
        TokenGeneratorInterface $tokenGenerator
    ) {
        // Form
        $form = $this->createForm(ResetPassType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $user = $userRepo->findOneByEmail($data['email']);

            if (!$user) {
                $this->addFlash('danger', 'Cette adresse n\'existe pas');

                $this->redirectToRoute('security_login');
            }

            $token = $tokenGenerator->generateToken();

            try {
                $user->setResetToken($token);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
            } catch (\Exception $e) {
                $this->addFlash('warning', 'Une erreur est survenue : ' . $e->getMessage());
                return $this->redirectToRoute('security_login');
            }

            // Generating url reset password
            $url = $this->generateUrl(
                'reset-password',
                ['token' => $token],
                UrlGeneratorInterface::ABSOLUTE_URL
            );

            // Sending the mail
            $message = (new \Swift_Message('Mot de passe oublié'))
                ->setFrom('votre@adresse.fr')
                ->setTo($user->getEmail())
                ->setBody(
                    "Bonjour,<br><br>Une demande de réinitialisation de mot de passe a été effectuée pour le 
                    site Alma Lusa. Veuillez cliquer sur le lien suivant : " . $url . '</p>',
                    'text/html'
                );

            $mailer->send($message);

            $this->addFlash('message', 'E-mail de réinitialisation du mot de passe envoyé !');

            return $this->redirectToRoute('security_login');
        }

        return $this->render('primary/user/password/forgotten_password.html.twig', ['emailForm' => $form->createView()]);
    }

    /**
     * @Route("/reset-pass/{token}", name="reset-password")
     */
    public function resetPassword($token, Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // Searching the user with appropriate token
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['reset_token' => $token]);

        if (!$user) {
            $this->addFlash('danger', 'Token inconnu');
            return $this->redirectToRoute('security_login');
        }
        // If form is sent in post method
        if ($request->isMethod('POST')) {
            // Delete the User token
            $user->setResetToken(null);

            // Crypting the password
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('message', 'Mot de pass modifié avec succès');

            return  $this->redirectToRoute('security_login');
        } else {
            return $this->render('primary/user/password/reset_password.html.twig', ['token' => $token]);
        }
    }
}
