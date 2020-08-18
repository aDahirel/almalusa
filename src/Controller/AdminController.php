<?php

// src/Controller/AdminController.php
namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Doctrine\Common\Persistence\ManagerRegistry;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin/creation-article/", name="article_create", methods="GET|POST")
     * @Route("/articles/{slug}/{id}/edit", name="article_edit", methods="GET|POST")
     *
     * @IsGranted("ROLE_ADMIN")
     */
    public function create(Article $article = null, Request $request, ManagerRegistry $managerRegistry)
    {
        // If the article variable empty, build a new Article
        if (!$article) {
            $article = new Article();
        }
        // Create the ArticleType form
        $form = $this->createForm(ArticleType::class, $article);
        // Process the form data
        $form->handleRequest($request);

        // If the submit button is pressed
        if ($form->isSubmitted() && $form->isValid()) {
            // Take the article slug
            $slug = $article->getSlug();
            // Save the created date if the article doesnt exist
            if (!$article->getId()) {
                $article->setCreatedAt(new \DateTime());
            }
            $article->setUpdatedAt(new \DateTime());
            // Process the form data
            $em = $managerRegistry->getManager();
            // Tell the manager to  persist
            $em->persist($article);
            // Send the article in the database
            $em->flush();
            // Add a flash message for the user
            $this->addFlash('success', 'Votre article a bien été créer');
            // Redirect to the new article
            return $this->redirectToRoute('article', [
                'id' => $article->getId(),
                'slug' => $article->getSlug()
            ]);
        }
        // Create the article view with the 'editMode'
        return $this->render('admin/create.html.twig', [
            'formArticle' => $form->createView(),
            'editMode' => $article->getId() !== null
        ]);
    }

    /**
     * @Route("/articles/{slug}/{id}/delete", name="article_delete", methods="DELETE")
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Article $article, ManagerRegistry $managerRegistry)
    {
        // Remove the article
        $em = $managerRegistry->getManager();
        $em->remove($article);
        $em->flush();
        // Redirect to tes articles list
        return $this->redirectToRoute('articles');
    }

}