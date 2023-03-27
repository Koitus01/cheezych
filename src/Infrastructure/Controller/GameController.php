<?php

namespace App\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GameController extends AbstractController
{
    /**
     * @Route ("/game/play-random", name="game-play-random")
     * */
    public function playRandom(): Response
    {
        $gameExists = (bool) rand(0, 1);
        if ($gameExists) {
            $id = 23;
            return $this->redirectToRoute('game-play', [
                'id' => $id, 'game_info' => []
            ]);
        } else {
            return $this->render('game/waiting.twig');
        }

    }

    /**
     * @Route ("/game/play/{id}", name="game-play")
     * */
    public function play(int $id): Response
    {
        return $this->render('game/play.twig', ['id' => $id]);
    }

    /**
     * @Route ("/game/start", name="game-start")
     * */
    public function start()
    {
        return $this->render('start.twig');
    }

    /**
     * @Route ("/game/end/{id}", name="game-end")
     * */
    public function stop(int $id)
    {

    }

    /**
     * @Route ("/game/pause/{id}", name="game-pause")
     * */
    public function pause(int $id)
    {

    }

    /**
     * @Route ("/game/wait/{id}", name="game-wait")
     * */
    public function wait(int $id)
    {

    }

    /**
     * Естественно, что пароль не будет передаваться в URI
     * @Route ("/game/register/{pass}", name="game-register")
     * */
    public function register(int $id)
    {

    }
}