<?php

declare(strict_types=1);

namespace App\EntityListener;

use App\Entity\Info;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::prePersist, entity: Info::class)]
#[AsEntityListener(event: Events::preUpdate, entity: Info::class)]
class InfoEntityListener extends EntityListenerWithSlugger
{
    public function prePersist(Info $info, LifecycleEventArgs $event): void
    {
        $info->createSlug($this->slugger);
    }

    public function preUpdate(Info $info, LifecycleEventArgs $event): void
    {
        $info->createSlug($this->slugger);
    }
}
