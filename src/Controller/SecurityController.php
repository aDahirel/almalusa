<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


use App\Entity\User;

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
        if($form->isSubmitted() && $form->isValid()){
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
        return $this->render('security/registration.html.twig', [
            'form' => $form->createview()
        ]);
    }

    /**
     * @Route("/connexion", name="security_login")
     */
    public function login(){
        // return to the connexion page
        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/deconnexion", name="security_logout")
     */
    public function logout(){}
}
