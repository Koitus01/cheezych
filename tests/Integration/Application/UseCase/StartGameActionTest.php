<?php

namespace App\Tests\Integration\Application\UseCase;

use App\Application\UseCase\StartGameAction;
use App\Tests\Unit\Domain\Actions\GameRepository;
use PHPUnit\Framework\TestCase;

class StartGameActionTest extends TestCase
{
    public function testStart()
    {
        $sga = new StartGameAction();
        $sga->execute(new GameRepository());
    }
}