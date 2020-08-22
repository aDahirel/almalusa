<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
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
use App\Form\ProfilePictureType;

class SecurityController extends AbstractController
{
    /**
     * @Route("/connexion", name="security_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // Get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // Last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        // Redirect to the same page
        return $this->render('primary/user/connexion/connexion.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     * @Route("/profile", name="profile")
     */
    public function profile(Request $request, ManagerRegistry $managerRegistry)
    {
        // Get the user
        $user = $this->getUser();
        // Create the ProfilePictureType form
        $form = $this->createForm(ProfilePictureType::class, $user);
        // Take the request
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $managerRegistry->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Photo modifiée !');
        }

        // Return to the same page with user data
        return $this->render('primary/user/profile/profile.html.twig', [
            'user' => $user,
            'form' => $form->createView()
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
        $fileName = $user->getFileName();

        if ($fileName == "default_user.png") {
        } else {
            // Remove the user in the database
            $em = $managerRegistry->getManager();
            $em->remove($user);
            $em->flush();
            // clear the session attribute
            $session = new Session();
            $session->invalidate();
            // Log out the user
            return $this->redirectToRoute('security_logout');
        }
    }

    /**
     * @Route("/forgotten_password", name="forgotten_password")
     */
    public function forgottenPass(
        Request $request,
        UserRepository $userRepo,
        \Swift_Mailer $mailer,
        TokenGeneratorInterface $tokenGenerator
    ) {
        // Create a reset password form
        $form = $this->createForm(ResetPassType::class);
        // Handle the request
        $form->handleRequest($request);
        // If the is valid and submitted
        if ($form->isSubmitted() && $form->isValid()) {
            // Get the form data
            $data = $form->getData();
            // Look in the database if the mail exists
            $user = $userRepo->findOneByEmail($data['email']);
            // If no email found
            if (!$user) {
                // Send a flash message to the user
                $this->addFlash('danger', 'Cette adresse n\'existe pas');
                // Redirect to the login page
                $this->redirectToRoute('security_login');
            } else {
                // Generate a token
                $token = $tokenGenerator->generateToken();
                // Trying to push in the database
                try {
                    $user->setResetToken($token);
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($user);
                    $entityManager->flush();
                } catch (\Exception $e) {
                    // Send a flash message to the user
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
                    // Expeditor
                    ->setFrom('votre@adresse.fr')
                    // Recipient
                    ->setTo($user->getEmail())
                    // Mail content
                    ->setBody(
                        "Bonjour,<br><br>Une demande de réinitialisation de mot de passe a été effectuée pour le 
        site Alma Lusa. Veuillez cliquer sur le lien suivant : " . $url . '</p>',
                        'text/html'
                    );
                // Sending mail
                $mailer->send($message);
                // Sending a  flash message to the user
                $this->addFlash('message', 'E-mail de réinitialisation du mot de passe envoyé !');
                // Redirect to the login page
                return $this->redirectToRoute('security_login');
            }
        }
        // Render the forgotten password view and form
        return $this->render('primary/user/password/forgotten_password.html.twig', ['emailForm' => $form->createView()]);
    }

    /**
     * @Route("/reset-pass/{token}", name="reset-password")
     */
    public function resetPassword($token, Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // Searching the user with appropriate token
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['reset_token' => $token]);
        // if no user found
        if (!$user) {
            // Error messageto the user
            $this->addFlash('danger', 'Token inconnu');
            // Login page redirection
            return $this->redirectToRoute('security_login');
        }
        // If form is sent in post method
        if ($request->isMethod('POST')) {
            // Delete the User token
            $user->setResetToken(null);
            // Crypting the password
            $user->setPassword($passwordEncoder->encodePassword($user, $request->request->get('password')));
            // Persisting user data in database
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // Sending flash message to the user
            $this->addFlash('message', 'Mot de pass modifié avec succès');
            // Return to the login page
            return  $this->redirectToRoute('security_login');
        } else {
            // Render the reset password view
            return $this->render('primary/user/password/reset_password.html.twig', ['token' => $token]);
        }
    }
}
