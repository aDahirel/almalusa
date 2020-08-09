<?php

/**
 * Blog Controller with article functions
 */

namespace App\Controller;

use App\Data\SearchData;
use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\User;
use App\Entity\Wording;
use App\Form\ArticleType;
use App\Form\CommentType;
use App\Form\SearchType;
use App\Form\WordingType;
use App\Repository\ArticleRepository;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class BlogController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(Request $request)
    {
        // Grab all the articles from the database
        $repo = $this->getDoctrine()->getRepository(Article::class);

        $newArticles = $repo->findBy([], ['createdAt' => 'DESC'], 1, 0);

        $articles = $repo->findBy([], ['createdAt' => 'DESC'], 10, 1);
        // Return the home view with a title variable
        return $this->render('primary/home.html.twig', [
            'articles' => $articles,
            'newArticles' => $newArticles
        ]);
    }

    /**
     * @Route("/blog", name="blog")
     */
    public function index(Request $request, PaginatorInterface $paginator, ArticleRepository $repository)
    {
        $data = new SearchData();
        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);

        // Grab all the articles from the database

        $articles = $paginator->paginate(

            $articles = $repository->findSearch($data),

            $request->query->getInt('page', 1),
            15
        );

        $repo = $this->getDoctrine()->getRepository(Wording::class);
        $wordings = $repo->findAll();

        // Return the articles list view with the articles
        return $this->render('primary/list.html.twig', [
            //'controller_name' => 'BlogController',
            'articles' => $articles,
            'wordings' => $wordings,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/adhesion", name="subscribtion")
     */
    public function Subscription()
    {
        // Return the home view with a title variable
        return $this->render('primary/membership.html.twig', [
            'title' => "Rejoignez-nous",
        ]);
    }

    // Function to Create or Edit an article

    /**
     * @Route("/blog/new", name="blog_create", methods="GET|POST")
     * @Route("/blog/{slug}/{id}/edit", name="blog_edit", methods="GET|POST")
     *
     * @IsGranted("ROLE_ADMIN")
     */
    public function form(Article $article = null, Request $request, ManagerRegistry $managerRegistry)
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
            $slug = $article->getSlug();
            // Save the created date if the article doesnt exist
            if (!$article->getId()) {
                $article->setCreatedAt(new \DateTime());
            }

            // Process the form data and send it
            $em = $managerRegistry->getManager();
            $em->persist($article);
            // send article
            $em->flush();
            $this->addFlash('success', 'Votre article a bien été créer');
            // Redirect to the new article
            return $this->redirectToRoute('blog_show', [
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
     * @Route("/blog/{slug}/{id}", name="blog_show", requirements={"slug": "[a-z0-9\-]*"}   )
     */
    public function show(string $slug, $id, Article $article, User $user = null, Request $request, ManagerRegistry $managerRegistry)
    {
        // Create a new comment
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $user = $this->getUser();

        $form->handleRequest($request);

        // If submit button pressed create a new comment
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setCreatedAt(new \DateTime())
                ->setArticle($article)
                ->setUser($user);

            $em = $managerRegistry->getManager();
            $em->persist($comment);
            $em->flush();

            $this->addFlash('success', 'Vous avez posté un commentaire');
            // redirect to the same page
            return $this->redirectToRoute('blog_show', [
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

    // Function to Delete an article

    /**
     * @Route("/blog/{slug}/{id}/delete", name="blog_delete", methods="DELETE")
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Article $article, Request $request, ManagerRegistry $managerRegistry)
    {
        $em = $managerRegistry->getManager();
        $em->remove($article);
        $em->flush();
        return $this->redirectToRoute('blog');
    }

    /**
     * @Route("/gestionProfile", name="profile_manager")
     */
    public function profileManager(Request $request, TokenGeneratorInterface $tokenGenerator)
    {
        if ($request->isMethod('POST')) {
            if ($request->request->get('user') === 'null') {
                return $this->redirectToRoute('user_profil');
            } else {

                return $this->redirectToRoute('forgotten_password');
            }
        }
        $user = $this->getUser();
        return $this->render('primary/user/profile.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/blog/{slug}/{idarticle}/{id}/delete_comment", name="delete_comment", methods="DELETE")
     */
    public function delete_comment($slug, $idarticle, Comment $comment, Request $request, ManagerRegistry $managerRegistry)
    {
        $em = $managerRegistry->getManager();
        $em->remove($comment);
        $em->flush();
        $this->addFlash('success', 'Vous avez bien supprimé ce commentaire');
        return $this->redirectToRoute('blog_show', [
            'slug' => $slug,
            'id' => $idarticle
        ]);
    }

    /**
     * @Route("/admin/category", name="category_edit", methods="GET|POST")
     *
     * @IsGranted("ROLE_ADMIN")
     */
    public function category_edit(Request $request, ManagerRegistry $managerRegistry)
    {
        $wording = new Wording();
        
        $form = $this->createForm(WordingType::class, $wording);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $em = $managerRegistry->getManager();
            $em->persist($wording);

            $em->flush();
            $this->addFlash('success', 'Votre catégorie a bien été créer');

            return $this->redirectToRoute('category_edit');
        }

        $repo = $this->getDoctrine()->getRepository(Wording::class);
        $wordings = $repo->findAll();

        return $this->render('admin/categories.html.twig', [
            'wordings' => $wordings,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/category/delete/{id}", name="delete_categorie", methods="DELETE")
     *
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete_categorie($id, ManagerRegistry $managerRegistry)
    {   
        $repo = $this->getDoctrine()->getRepository(Wording::class);
        $wording = $repo->find($id);

        $em = $managerRegistry->getManager();
        $em->remove($wording);
        $em->flush();
       
        $this->addFlash('success', 'Vous avez bien supprimé cette catégorie');
        return $this->redirectToRoute('category_edit');
    }
}
