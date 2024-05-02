<?php

declare(strict_types=1);

namespace App\EntityListener;

use App\Entity\Category;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::prePersist, entity: Category::class)]
#[AsEntityListener(event: Events::preUpdate, entity: Category::class)]
class CategoryEntityListener extends EntityListenerWithSlugger
{
    public function prePersist(Category $category, LifecycleEventArgs $event): void
    {
        $category->createSlug($this->slugger);
    }

    public function preUpdate(Category $category, LifecycleEventArgs $event): void
    {
        $category->createSlug($this->slugger);
    }
}
