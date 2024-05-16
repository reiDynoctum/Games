<?php

namespace App\EventSubscriber;

use App\Repository\CategoryRepository;
use App\Repository\InfoRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private Environment $twig,
        private CategoryRepository $categoryRepository,
        private InfoRepository $infoRepository,
    ) {
    }

    public function onKernelController(ControllerEvent $event): void
    {
        $this->twig->addGlobal('categories', $this->categoryRepository->findBy([], ['name' => 'ASC']));
        $this->twig->addGlobal('info_pages', $this->infoRepository->getInfoPagesFooter());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}
