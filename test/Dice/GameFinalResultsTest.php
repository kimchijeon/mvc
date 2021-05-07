<?php

namespace Kimchi\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class GameFinalResults.
 */
class GameFinalResultsTest extends TestCase
{
    /**
     * Verify that if bot has higher number than 21 player wins.
     */
    public function testGameShowFinalResultsBotHigherThan21()
    {
        $game = new GameFinalResults();
        $this->assertInstanceOf("\Kimchi\Dice\GameFinalResults", $game);

        $_SESSION["playertotal"] = 19;
        $_SESSION["bottotal"] = 22;
        $data = $game->showFinalResults();

        $this->expectOutputString("You win!");

        print $data["getResultMessage"];
    }

    /**
     * Verify that if the player has 21, player wins.
     */
    public function testGameShowFinalResultsPlayer21Win()
    {
        $game = new GameFinalResults();
        $this->assertInstanceOf("\Kimchi\Dice\GameFinalResults", $game);

        $_SESSION["playertotal"] = 21;
        $data = $game->showFinalResults();

        $this->expectOutputString("You win!");

        print $data["getResultMessage"];
    }

    /**
     * Verify that if bot and player has same number, the bot wins.
     */
    public function testGameShowFinalResultsSameNumber()
    {
        $game = new GameFinalResults();
        $this->assertInstanceOf("\Kimchi\Dice\GameFinalResults", $game);

        $_SESSION["bottotal"] = 19;
        $_SESSION["playertotal"] = 19;
        $data = $game->showFinalResults();

        $this->expectOutputString("Bot wins!");

        print $data["getResultMessage"];
    }

    /**
     * Verify that if bot has higher number than player, bot wins.
     */
    public function testGameShowFinalResultsBotHigherThanPlayer()
    {
        $game = new GameFinalResults();
        $this->assertInstanceOf("\Kimchi\Dice\GameFinalResults", $game);

        $_SESSION["bottotal"] = 20;
        $_SESSION["playertotal"] = 19;
        $data = $game->showFinalResults();

        $this->expectOutputString("Bot wins!");

        print $data["getResultMessage"];
    }

    /**
     * Verify that if player decides to play with bot despite
     * having number higher than 21, they're both losers.
     */
    public function testGameShowFinalResultsBothLosers()
    {
        $game = new GameFinalResults();
        $this->assertInstanceOf("\Kimchi\Dice\GameFinalResults", $game);

        $_SESSION["playertotal"] = 22;
        $data = $game->showFinalResults();

        $this->expectOutputString("You're both losers.");

        print $data["getResultMessage"];
    }

    /**
     * Verify that if $_SESSION["wins"] is unset $data["getWins"] is 0.
     */
    public function testGameShowScoreboardGetWins()
    {
        $game = new GameFinalResults();
        $this->assertInstanceOf("\Kimchi\Dice\GameFinalResults", $game);

        $_SESSION["win"] = null;

        $data = $game->showScoreboard();

        $res = $data["getWins"];
        $exp = 0;
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify that if $message is "You win" $_SESSION["win"] is increased by 1.
     */
    public function testGameShowScoreboard()
    {
        $game = new GameFinalResults();
        $this->assertInstanceOf("\Kimchi\Dice\GameFinalResults", $game);

        $_SESSION["playertotal"] = 21;
        $data = $game->showFinalResults();
        $message = $data["getResultMessage"];

        $_SESSION["win"] = 1;
        $game->showScoreboard();

        $res = $_SESSION["win"];
        $exp = 2;
        $this->assertEquals($exp, $res);
    }
}
