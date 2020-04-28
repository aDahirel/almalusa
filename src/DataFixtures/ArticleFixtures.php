<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Wording;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $faker = \Faker\Factory::create('fr_FR');

        // Create 5 fake wordings
        for ($i = 1; $i <= 5; $i++) {
            $wording = new Wording();
            $wording->setTitle($faker->name())
                    ->setDescription($faker->paragraph());

            $manager->persist($wording);

            // Create 30 random articles
            for ($j = 1; $j <= 30; $j++) {
                $article = new Article();

                $content = '<p>' . join($faker->paragraphs(5), '</p><p>') . '</p>';
                $now = new \DateTime();
                $article->setTitle($faker->sentence())
                    ->setContent($content)
                    ->setCreatedAt($faker->dateTimeBetween('-6 months'))
                    ->setUpdatedAt(new \DateTime(sprintf('-%d days', rand(1, 100))))
                    ->addWording($wording);

                $manager->persist($article);

                // on donne des commentaires à l'article
                for ($k = 1; $k <= mt_rand(4, 10); $k++) {
                    $comment = new Comment();

                    $content = '<p>' . join($faker->paragraphs(1), '</p><p>') . '</p>';

                    $now = new \DateTime();
                    $days = $now->diff($article->getCreatedAt())->days;



                    $comment->setContent($content)
                            ->setCreatedAt($faker->dateTimeBetween('-' . $days . ' days'))
                            ->setArticle($article)
                            ->setUser($this->getReference(UserFixtures::USER_REFERENCE));

                    $manager->persist($comment);
                }
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            UserFixtures::class,
        );
    }
}
