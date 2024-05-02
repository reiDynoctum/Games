<?php

declare(strict_types=1);

namespace App\EntityListener;

use Symfony\Component\String\Slugger\SluggerInterface;

class EntityListenerWithSlugger {
    public function __construct(protected SluggerInterface $slugger)
    {
    }
}
