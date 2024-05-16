<?php

namespace App\Controller;

use App\Entity\Info;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InfoController extends AbstractController
{
    #[Route('/info/{slug}', name: 'app_info')]
    public function show(Info $info): Response
    {
        return $this->render('info/show.html.twig', [
            'info' => $info,
        ]);
    }
}
