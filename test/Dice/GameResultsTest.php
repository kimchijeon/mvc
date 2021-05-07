<?php

namespace Kimchi\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class GameResults.
 */
class GameResultsTest extends TestCase
{
    /**
     * Verify that if $_SESSION["dicetotal"] is set it is equal to $data["sumDice"].
     */
    public function testGameShowResultsDiceSessionSet()
    {
        $game = new GameResults();
        $this->assertInstanceOf("\Kimchi\Dice\GameResults", $game);

        $_SESSION["dicetotal"] = 15;

        $data = $game->showResults();

        $res = $data["sumDice"];
        $exp = 15;
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify that if $_SESSION["dicetotal"] is more than 21 you lose.
     */
    public function testGameShowResultsLoss()
    {
        $game = new GameResults();
        $this->assertInstanceOf("\Kimchi\Dice\GameResults", $game);

        $_SESSION["dicetotal"] = 22;
        $data = $game->showResults();

        $this->expectOutputString("You lose!");

        print $data["notice"];
    }

    /**
     * Verify that if $_SESSION["dicetotal"] is 21 you win.
     */
    public function testGameShowResultsWin()
    {
        $game = new GameResults();
        $this->assertInstanceOf("\Kimchi\Dice\GameResults", $game);

        $_SESSION["dicetotal"] = 21;
        $data = $game->showResults();

        $this->expectOutputString("You win!");

        print $data["notice"];
    }

    /**
     * Verify that if $_SESSION["dicehand"] is set it is equal
     * to $data["lastRoll"].
     */
    public function testGameShowResultsLastRollSet()
    {
        $game = new GameResults();
        $this->assertInstanceOf("\Kimchi\Dice\GameResults", $game);

        $_SESSION["dicehand"] = 4;

        $data = $game->showResults();

        $res = $data["lastRoll"];
        $exp = 4;
        $this->assertEquals($exp, $res);
    }
}
