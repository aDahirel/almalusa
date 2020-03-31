<?php

/**
 * Blog Controller with article functions
 */
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Knp\Component\Pager\PaginatorInterface;
use App\Entity\Article;
use App\Entity\Comment;
use App\Entity\Wording;
use App\Form\ArticleType;
use App\Form\CommentType;
use App\Repository\ArticleRepository;

class BlogController extends AbstractController
{

    /**
     * @Route("/blog", name="blog")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        // Grab all the articles from the database
        $repo = $this->getDoctrine()->getRepository(Article::class);

        $articles = $paginator->paginate(
            $order = $repo->findAllDesc(),
            $request->query->getInt('page', 1),
            5
        );

        $repo = $this->getDoctrine()->getRepository(Wording::class);
        $wordings = $repo->findAll();

        // Return the articles list view with the articles
        return $this->render('blog/index.html.twig', [
            'articles' => $articles,
            'wordings' => $wordings
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        // Return the home view with a title variable
        return $this->render('blog/home.html.twig');
    }

    // Function to Create or Edit an article
    /**
     * @Route("/blog/new", name="blog_create", methods="GET|POST")
     * @Route("/blog/{id}/edit", name="blog_edit", methods="GET|POST")
     * 
     * @IsGranted("ROLE_ADMIN")
     */
    public function form(Article $article = null, Request $request, ManagerRegistry $managerRegistry)
    {
        // If the article variable empty, build a new Article
        if(!$article){
            $article = new Article();
        }

        // Create the ArticleType form
        $form = $this->createForm(ArticleType::class, $article);

        // Process the form data
        $form->handleRequest($request);

        // If the submit button is pressed
        if($form->isSubmitted() && $form->isValid()){

            // Save the created date if the article doesnt exist
            if(!$article->getId()){
                $article->setCreatedAt(new \DateTime());
            }

            // Process the form data and send it
            $em = $managerRegistry->getManager();
            $em->persist($article);
            $em->flush();
            // Redirect to the new article
            return $this->redirectToRoute('blog_show', ['id' => $article->getId
            ()]);
        }
        // Create the article view with the 'editMode'
        return $this->render('admin/create.html.twig', [
            'formArticle' => $form->createView(),
            'editMode' => $article->getId() !== null
        ]);
    }


    /**
     * @Route("/blog/{id}", name="blog_show")
     */
    public function show($id, Article $article, Request $request, ManagerRegistry $managerRegistry)
    {
        // Create a new comment
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);

        $form->handleRequest($request);

        // If submit button pressed create a new comment
        if($form->isSubmitted() && $form->isValid())
        {
            $comment->setCreatedAt(new \DateTime())
                    ->setArticle($article);

            $em = $managerRegistry->getManager();
            $em->persist($comment);
            $em->flush();

            // redirect to the same page
            return $this->redirectToRoute('blog_show', ['id' => $article->getId()]);

        }

        // Search the article id
        $repo = $this->getDoctrine()->getRepository(Article::class);
        $article  = $repo->find($id);

        //return the same page with a new comment
        return $this->render('blog/show.html.twig', [
            'article' => $article,
            'commentForm' => $form->createView()
        ]);
    }

    // Function to Delete an article
    /**
     * @Route("/blog/{id}/delete", name="blog_delete", methods="DELETE")
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Article $article, Request $request, ManagerRegistry $managerRegistry)
    {
        $em = $managerRegistry->getManager();
        $em->remove($article);
        $em->flush();
        return $this->redirectToRoute('blog');
    }
}
