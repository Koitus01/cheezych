<?php

namespace App\Domain\Enums;

enum GameStatus: string
{
    case FINISHED = 'finished';
    case ACTIVE = 'active';
    case ABANDONED = 'abandoned';
    case WAITING = 'waiting'; # TODO: ожидающая игрока??? Или не начинать игру, пока нет двух игроков?
}
