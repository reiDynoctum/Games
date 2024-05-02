<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Info;
use App\Entity\Post;
use App\Entity\User;
use App\Enums\UserRoles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Faker;
use Faker\Calculator\Inn;

class AppFixtures extends Fixture
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create();

        $user = new User();
        $user->setName('Jakub Pradeniak')
            ->setEmail('jpradeniak@gmail.com')
            ->setRoles([UserRoles::Admin])
            ->setPassword(
                $this->passwordHasher->hashPassword(
                    $user,
                    '123456789'
                )
            );
        $manager->persist($user);

        for ($i = 0; $i < 5; $i++) {
            $category = new Category();
            $category->setName($faker->word());
            $manager->persist($category);

            $postCount = $faker->numberBetween(5, 25);
            for ($j = 0; $j < $postCount; $j++) {
                $content = array_reduce(
                    $faker->paragraphs($faker->numberBetween(10, 25)),
                    fn ($text, $paragraph) => $text .= "<p>$paragraph</p>",
                    ""
                );
                                
                $post = new Post();
                $post->setName($faker->words(3, true))
                    ->setContent($content)
                    ->setImage('pocitace.png')
                    ->setAuthor($user);
                $category->addPost($post);
                $manager->persist($post);

                $commentsCount = $faker->numberBetween(0, 10);
                for ($k = 0; $k < $commentsCount; $k++) {
                    $comment = new Comment();
                    $comment->setAuthorName($faker->firstName())
                        ->setContent($faker->paragraph());
                    $post->addComment($comment);
                    $manager->persist($comment);
                }
            }
        }

        for ($i = 0; $i < 3; $i++) {
            $content = array_reduce(
                $faker->paragraphs($faker->numberBetween(10, 25)),
                fn ($text, $paragraph) => $text .= "<p>$paragraph</p>",
                ""
            );
            
            $info = new Info();
            $info->setName($faker->word())
                ->setContent($content);
            $manager->persist($info);
        }

        $manager->flush();
    }
}
