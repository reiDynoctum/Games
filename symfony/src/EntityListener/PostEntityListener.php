<?php

declare(strict_types=1);

namespace App\EntityListener;

use App\Entity\Post;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::prePersist, entity: Post::class)]
#[AsEntityListener(event: Events::preUpdate, entity: Post::class)]
class PostEntityListener extends EntityListenerWithSlugger
{
    public function prePersist(Post $post, LifecycleEventArgs $event): void
    {
        $post->createSlug($this->slugger);
    }

    public function preUpdate(Post $post, LifecycleEventArgs $event): void
    {
        $post->createSlug($this->slugger);
    }
}
