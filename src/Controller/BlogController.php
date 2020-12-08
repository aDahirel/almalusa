<?php

// src/Controller/BlogController.php
namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\User;
use App\Entity\Category;
use App\Form\CommentType;
use App\Form\SearchType;
use App\Repository\ArticleRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        // Take all the articles from the database
        $repo = $this->getDoctrine()->getRepository(Article::class);

        // Take the most recent article
        $lastArticle = $repo->findBy([], ['createdAt' => 'DESC'], 1, 0);

        // Takes the 10 most recent articles without the very first one
        $articles = $repo->findBy([], ['createdAt' => 'DESC'], 10, 1);

        // Redirect to the homepage with the articles
        return $this->render('primary/home.html.twig', [
            'articles' => $articles,
            'lastArticle' => $lastArticle
        ]);
    }

    /**
     * @Route("/articles", name="articles")
     */
    public function articles(Request $request, PaginatorInterface $paginator, ArticleRepository $repository)
    {
        // Initializing a data object
        $data = new SearchData();
        // Create a search form
        $form = $this->createForm(SearchType::class, $data);
        // Take the request
        $form->handleRequest($request);

        // Paginates all the articles from the db
        $articles = $paginator->paginate(
            // Get the articles related to the search
            $articles = $repository->findSearch($data),
            // Paginate with n number articles on a page
            $request->query->getInt('page', 1),
            15
        );

        // Bring all the categories from the database
        $repo = $this->getDoctrine()->getRepository(Category::class);
        // Bring all the categories
        $categories = $repo->findAll();

        // Return the view with the articles
        return $this->render('primary/articles.html.twig', [
            'articles' => $articles,
            'categories' => $categories,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/adhesion", name="membership")
     */
    public function membership()
    {
        // Render the membership page
        return $this->render('primary/membership.html.twig');
    }

    /**
     * @Route("/mentions-legales", name="legalNotice")
     */
    public function legalNotice()
    {
        // Render the legal notice view
        return $this->render('modules/notice.html.twig');
    }

    /**
     * @Route("/articles/{slug}/{id}", name="article", requirements={"slug": "[a-z0-9\-]*"}   )
     */
    public function article($id, Article $article, User $user = null, Request $request, ManagerRegistry $managerRegistry)
    {
        // Create a new comment
        $comment = new Comment();
        // Create the CommentType form
        $form = $this->createForm(CommentType::class, $comment);
        // Get the user
        $user = $this->getUser();
        // Inspect request
        $form->handleRequest($request);
        // Create a new comment if the form is valid
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setCreatedAt(new \DateTime())
                ->setArticle($article)
                ->setUser($user);
            // Process the form data
            $em = $managerRegistry->getManager();
            // Persist the data
            $em->persist($comment);
            // Send the comment in the database
            $em->flush();
            // Add a flash message for the user
            $this->addFlash('success', 'Vous avez posté un commentaire');
            // Redirect to the same page with the new comment
            return $this->redirectToRoute('article', [
                'id' => $article->getId(),
                'slug' => $article->getSlug()
            ]);
        }

        // Search the article id
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $article = $repo->find($id);

        //return the same page with a new comment
        return $this->render('primary/article/article.html.twig', [
            'article' => $article,
            'commentForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/blog/{slug}/{idarticle}/{id}/delete_comment", name="delete_comment", methods="DELETE")
     */
    public function delete_comment($slug, $idarticle, Comment $comment, ManagerRegistry $managerRegistry)
    {
        // Remove the comment
        $em = $managerRegistry->getManager();
        $em->remove($comment);
        // Remove the comment in the database
        $em->flush();
        // Add a flash message to the user
        $this->addFlash('success', 'Vous avez bien supprimé ce commentaire');
        // Return to the same article
        return $this->redirectToRoute('article', [
            'slug' => $slug,
            'id' => $idarticle
        ]);
    }
}
