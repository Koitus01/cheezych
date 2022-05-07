<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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