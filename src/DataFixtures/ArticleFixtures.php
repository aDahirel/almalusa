<?php

namespace App\DataFixtures;

use App\DataFixtures\Faker;
use App\Entity\Article;
use App\Entity\Wording;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        $faker = \Faker\Factory::create('fr_FR');

        // Create 3 fake wordings
        for($i = 1; $i <= 3; $i++){
            $wording = new Wording();
            $wording->setTitle($faker->name())
                     ->setDescription($faker->paragraph());

                
            $manager->persist($wording);
            
            // Create 4, 6 random articles
            for($j = 1; $j <= mt_rand(4,6); $j++){
                $article = new Article();

                $content = '<p>' . join($faker->paragraphs(5), '</p><p>') . '</p>';
                $now = new \DateTime();
                $article->setTitle($faker->sentence())
                        ->setContent($content)
                        ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                        ->setFileName($faker->imageUrl($width = 640, $height = 480))
                        ->setUpdatedAt(new \DateTime(sprintf('-%d days', rand(1, 100))))
                        ->addWording($wording);
    
                $manager->persist($article);

                // on donne des commentaires à l'article
                for($k = 1; $k <= mt_rand(4,10); $k++){
                    $comment = new Comment();

                    $content = '<p>' . join($faker->paragraphs(5), '</p><p>') . '</p>';

                    $now = new \DateTime();
                    $days = $now->diff($article->getCreatedAt()) ->days;

                    $comment->setAuthor($faker->name)
                            ->setContent($content)
                            ->setCreatedAt($faker->dateTimeBetween('-' . $days . ' days'))
                            ->setArticle($article);

                    $manager->persist($comment);
                }
            }
        }
        $manager->flush();
    }
}
