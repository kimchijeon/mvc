<?php

namespace Kimchi\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Game.
 */
class GameTest extends TestCase
{
    /**
     * Construct object and verify that the object is of the correct class.
     */
    public function testCreateGameObject()
    {
        $game = new Game();
        $this->assertInstanceOf("\Kimchi\Dice\Game", $game);
    }

    /**
     * Verify that the posted number is the same number saved in the session.
     */
    public function testGameSetDiceNumber()
    {
        $game = new Game();

        $_POST["submit"] = "Play!";
        $_POST["number"] = 1;

        $game->setDiceNumber();

        $res = $_SESSION["number"];
        $exp = 1;
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify that the first time playGame() is called that $_SESSION["dicetotal"]
     * contains the sum of $_SESSION["dicehand"].
     */
    public function testGameFirstPlayGame()
    {
        $game = new Game();
        $_SESSION["dicetotal"] = null;

        $_POST["submit"] = "Play!";
        $_POST["number"] = 1;
        $game->setDiceNumber();

        $game->playGame();
        $res = $_SESSION["dicetotal"];
        $exp = array_sum($_SESSION["dicehand"]);
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify that when $_SESSION["dicetotal"] is set that $_SESSION["dicetotal"]
     * contains the sum of $_SESSION["dicehand"] and the current $_SESSION["dicetotal"].
     */
    public function testGameMultiplePlayGame()
    {
        $game = new Game();

        $_POST["submit"] = "Play!";
        $_POST["number"] = 1;
        $game->setDiceNumber();

        $game->playGame();
        $res = $_SESSION["dicetotal"];
        $game->playGame();
        $exp = $_SESSION["dicetotal"] - array_sum($_SESSION["dicehand"]);

        $this->assertEquals($exp, $res);
    }

    /**
     * Verify that the posted 'playerdice' is the same number saved in
     * $_SESSION["playertotal"].
     */
    public function testGameSavePlayerTotal()
    {
        $game = new Game();

        $_POST["submit"] = "Stop rolling";
        $_POST["playerdice"] = 19;

        $game->savePlayerTotal();

        $res = $_SESSION["playertotal"];
        $exp = 19;
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify that $data["getPlayerTotal"] is correct.
     */
    public function testGamePrepareBotGame()
    {
        $game = new Game();

        $_SESSION["playertotal"] = 15;

        $data = $game->prepareBotGame();

        $res = $data["getPlayerTotal"];
        $exp = 15;
        $this->assertEquals($exp, $res);
    }

    /**
     * Verify the bot will roll until it has a higher number than the player.
     */
    public function testGameBotFirstRoll()
    {
        $game = new Game();
        $_SESSION["bottotal"] = null;
        $_SESSION["playertotal"] = 19;

        $game->botRoll();

        $this->assertGreaterThanOrEqual($_SESSION["playertotal"], $_SESSION["bottotal"]);
    }

    /**
     * Verify that if prepareGame() is called the session is nullified correctly.
     */
    public function testGamePrepareGame()
    {
        $game = new Game();

        $_SESSION["number"] = 1;
        $_SESSION["dicehand"] = 1;
        $_SESSION["dicetotal"] = 1;
        $_SESSION["playertotal"] = 1;
        $_SESSION["bothand"] = 1;
        $_SESSION["bottotal"] = 1;

        $game->prepareGame();

        $this->assertEmpty($_SESSION["number"]);
        $this->assertEmpty($_SESSION["dicehand"]);
        $this->assertEmpty($_SESSION["dicetotal"]);
        $this->assertEmpty($_SESSION["playertotal"]);
        $this->assertEmpty($_SESSION["bothand"]);
        $this->assertEmpty($_SESSION["bottotal"]);
    }
}
