<?php

namespace App\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController
{
    /**
    * @Route("/")
    */
    public function mainPage(): Response
    {
        return $this->render('main.twig', [
            'new_game_hash' => 'rwrqrq221'
        ]);
    }
}