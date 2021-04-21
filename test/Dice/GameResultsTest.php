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

    /**
     * Verify that if bot has higher number than 21 player wins.
     */
    public function testGameShowFinalResultsBotHigherThan21()
    {
        $game = new GameResults();
        $this->assertInstanceOf("\Kimchi\Dice\GameResults", $game);

        $_SESSION["bottotal"] = 22;
        $data = $game->showFinalResults();

        $this->expectOutputString("You win!");

        print $data["getFinalResults"];
    }

    /**
     * Verify that if the player has 21, player wins.
     */
    public function testGameShowFinalResultsPlayer21Win()
    {
        $game = new GameResults();
        $this->assertInstanceOf("\Kimchi\Dice\GameResults", $game);

        $_SESSION["playertotal"] = 21;
        $data = $game->showFinalResults();

        $this->expectOutputString("You win!");

        print $data["getFinalResults"];
    }

    /**
     * Verify that if bot and player has same number, the bot wins.
     */
    public function testGameShowFinalResultsSameNumber()
    {
        $game = new GameResults();
        $this->assertInstanceOf("\Kimchi\Dice\GameResults", $game);

        $_SESSION["bottotal"] = 19;
        $_SESSION["playertotal"] = 19;
        $data = $game->showFinalResults();

        $this->expectOutputString("Bot wins!");

        print $data["getFinalResults"];
    }

    /**
     * Verify that if bot has higher number than player, bot wins.
     */
    public function testGameShowFinalResultsBotHigherThanPlayer()
    {
        $game = new GameResults();
        $this->assertInstanceOf("\Kimchi\Dice\GameResults", $game);

        $_SESSION["bottotal"] = 20;
        $_SESSION["playertotal"] = 19;
        $data = $game->showFinalResults();

        $this->expectOutputString("Bot wins!");

        print $data["getFinalResults"];
    }

    /**
     * Verify that if player decides to play with bot despite
     * having number higher than 21, they're both losers.
     */
    public function testGameShowFinalResultsBothLosers()
    {
        $game = new GameResults();
        $this->assertInstanceOf("\Kimchi\Dice\GameResults", $game);

        $_SESSION["playertotal"] = 22;
        $data = $game->showFinalResults();

        $this->expectOutputString("You're both losers.");

        print $data["getFinalResults"];
    }

    /**
     * Verify that if $_SESSION["wins"] is unset $data["getWins"] is 0.
     */
    public function testGameShowFinalResultsGetWins()
    {
        $game = new GameResults();
        $this->assertInstanceOf("\Kimchi\Dice\GameResults", $game);

        $_SESSION["wins"] = null;

        $data = $game->showFinalResults();

        $res = $data["getWins"];
        $exp = 0;
        $this->assertEquals($exp, $res);
    }
}
