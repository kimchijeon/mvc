<?php

declare(strict_types=1);

namespace Kimchi\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller Game21.
 */
class ControllerGame21Test extends TestCase
{
    /**
     * Try to create the controller class.
     */
    public function testCreateTheControllerClass()
    {
        $controller = new Game21();
        $this->assertInstanceOf("\Kimchi\Controller\Game21", $controller);
    }

    /**
     * Check that the controller returns a response.
     * Index.
     * @runInSeparateProcess
     */
    public function testControllerIndexResponse()
    {
        $controller = new Game21();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->index();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that the controller returns a response.
     * Game.
     * @runInSeparateProcess
     */
    public function testControllerGameResponse()
    {
        $controller = new Game21();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->game();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check the controller action.
     * SetDiceProcess.
     * @runInSeparateProcess
     */
    public function testControllerSetDiceProcessAction()
    {
        $controller = new Game21();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->setDiceProcess();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check the controller action.
     * Play.
     * @runInSeparateProcess
     */
    public function testControllerPlayAction()
    {
        $_SESSION["number"] = 1;
        $controller = new Game21();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->play();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check the controller action.
     * BotProcess.
     * @runInSeparateProcess
     */
    public function testControllerBotProcessAction()
    {
        $controller = new Game21();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->botProcess();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that the controller returns a response.
     * BotGame.
     * @runInSeparateProcess
     */
    public function testControllerBotGameResponse()
    {
        $_SESSION["playertotal"] = 19;
        $controller = new Game21();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->botGame();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check the controller action.
     * BotPlay.
     * @runInSeparateProcess
     */
    public function testControllerBotPlayAction()
    {
        $controller = new Game21();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->botPlay();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that the controller returns a response.
     * Result.
     * @runInSeparateProcess
     */
    public function testControllerResultResponse()
    {
        $_SESSION["playertotal"] = 19;
        $_SESSION["bottotal"] = 20;

        $controller = new Game21();

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->result();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Destroy the session.
     * @runInSeparateProcess
     */
    public function testControllerRestart()
    {
        session_start();
        $controller = new Game21();

        $_SESSION = [
            "key" => "value"
        ];

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->restart();
        $this->assertInstanceOf($exp, $res);
        $this->assertEmpty($_SESSION);
    }
}
