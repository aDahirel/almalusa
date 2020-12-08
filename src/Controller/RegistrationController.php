<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RegistrationType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Security\UserAuthenticator;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class RegistrationController extends AbstractController
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
        // Create a user entity
        $user = new User();
        // Create the registration form
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
            // Set the actual date
            $user->setCreatedAt((new \DateTime('now')));
            // Set the updated date
            $user->setUpdatedAt((new \DateTime('now')));

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
                    // Mail content file
                    $this->renderView(
                        'primary/user/activation.html.twig',
                        ['token' => $user->getActivationToken()]
                    ),
                    'text/html'
                );

            // Sending mail
            $mailer->send($message);
            // Add a flash message to the user
            $this->addFlash('success', 'Vous avez créé votre profil');
            // Method for authenticating the user and returning the Response
            return $guardHandler->authenticateUserAndHandleSuccess($user, $request, $authenticator, 'main');

            // Return to the login page
            return $this->redirectToRoute('home');
        }
        // Return the inscription page
        return $this->render('primary/user/connexion/registration.html.twig', [
            'formRegister' => $form->createview()
        ]);
    }
    /**
     * @Route("activation/{token}", name="activation")
     */
    public function activation($token, UserRepository $user)
    {
        // Veryfing if the user has an activation token
        $user = $user->findOneBy(['activation_token' => $token]);
        // If no user exists with the token
        if (!$user) {
            // Send an error 404
            throw $this->createNotFoundException('Cet utilisateur n\'existe pas');
        }
        // Deleting the token
        $user->setActivationToken(null);
        // Set the a new role to the user
        $user->setRoles(array('ROLE_VERIFIED_USER'));
        // Update the database
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        // Sending flash message
        $this->addFlash('success', 'Vous avez  bien activé votre compte');
        // Returning to home page
        return $this->redirectToRoute('home');
    }
}
