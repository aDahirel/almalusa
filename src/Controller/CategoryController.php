<?php

// src/Controller/CategoryController.php
namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Doctrine\Common\Persistence\ManagerRegistry;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/admin/category", name="category_edit", methods="GET|POST")
     *
     * @IsGranted("ROLE_ADMIN")
     */
    public function category_edit(Request $request, ManagerRegistry $managerRegistry)
    {
        // Create a new Category object
        $category = new Category();
        // Create the category form
        $form = $this->createForm(CategoryType::class, $category);
        // Inspect the request
        $form->handleRequest($request);
        // Check  if the form is valid
        if ($form->isSubmitted() && $form->isValid()) {
            // Send the category in the database
            $em = $managerRegistry->getManager();
            $em->persist($category);
            $em->flush();
            // Add a flash message to the user
            $this->addFlash('success', 'Votre catégorie a bien été créer');
            // Return to the same page
            return $this->redirectToRoute('category_edit');
        }
        // Get the category repository
        $repo = $this->getDoctrine()->getRepository(Category::class);
        // Display all the categories
        $categories = $repo->findAll();
        // Return to the categories page with form
        return $this->render('admin/categories.html.twig', [
            'categories' => $categories,
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
        // Get the categories repository
        $repo = $this->getDoctrine()->getRepository(Category::class);
        // Search the category by his id
        $category = $repo->find($id);
        // Remove the category in the database
        $em = $managerRegistry->getManager();
        $em->remove($category);
        $em->flush();
        // Add a flash message to the user
        $this->addFlash('success', 'Vous avez bien supprimé cette catégorie');
        // Redirect to the same page
        return $this->redirectToRoute('category_edit');
    }
}
