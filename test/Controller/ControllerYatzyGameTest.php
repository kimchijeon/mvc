<?php

declare(strict_types=1);

namespace Kimchi\Controller;

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

/**
 * Test cases for the controller YatzyGame.
 */
class ControllerYatzyGameTest extends TestCase
{
    /**
     * Check that the controller returns a response.
     * Index.
     */
    public function testControllerIndexResponse()
    {
        $controller = new YatzyGame();
        $this->assertInstanceOf("\Kimchi\Controller\YatzyGame", $controller);

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->index();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check the controller action.
     * SetRoundProcess.
     */
    public function testControllerSetRoundProcessAction()
    {
        $controller = new YatzyGame();
        $this->assertInstanceOf("\Kimchi\Controller\YatzyGame", $controller);

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->setRoundProcess();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that the controller returns a response.
     * Game.
     */
    public function testControllerGameResponse()
    {
        $_SESSION["round"] = 1;
        $controller = new YatzyGame();
        $this->assertInstanceOf("\Kimchi\Controller\YatzyGame", $controller);

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->game();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check the controller action.
     * FirstRoll.
     */
    public function testControllerFirstRollAction()
    {
        $controller = new YatzyGame();
        $this->assertInstanceOf("\Kimchi\Controller\YatzyGame", $controller);

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->firstRoll();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that the controller returns a response.
     * GameFirstRoll.
     */
    public function testControllerGameFirstRollResponse()
    {
        $controller = new YatzyGame();
        $this->assertInstanceOf("\Kimchi\Controller\YatzyGame", $controller);

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->gameFirstRoll();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that controller action.
     * SecondRoll.
     */
    public function testControllerSecondRollAction()
    {
        $controller = new YatzyGame();
        $this->assertInstanceOf("\Kimchi\Controller\YatzyGame", $controller);

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->secondRoll();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that the controller returns a response.
     * GameSecondRoll.
     */
    public function testControllerGameSecondRollResponse()
    {
        $controller = new YatzyGame();
        $this->assertInstanceOf("\Kimchi\Controller\YatzyGame", $controller);

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->gameSecondRoll();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that controller action.
     * ThirdRoll.
     */
    public function testControllerThirdRollAction()
    {
        $controller = new YatzyGame();
        $this->assertInstanceOf("\Kimchi\Controller\YatzyGame", $controller);

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->thirdRoll();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that the controller returns a response.
     * GameThirdRoll.
     */
    public function testControllerGameThirdRollResponse()
    {
        $controller = new YatzyGame();
        $this->assertInstanceOf("\Kimchi\Controller\YatzyGame", $controller);

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->gameThirdRoll();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Check that the controller returns a response.
     * RoundEndResults.
     */
    public function testControllerRoundEndResultsResponse()
    {
        $controller = new YatzyGame();
        $this->assertInstanceOf("\Kimchi\Controller\YatzyGame", $controller);

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->roundEndResults();
        $this->assertInstanceOf($exp, $res);
    }

    /**
     * Destroy the session.
     * @runInSeparateProcess
     */
    public function testControllerRestart()
    {
        session_start();
        $controller = new YatzyGame();
        $this->assertInstanceOf("\Kimchi\Controller\YatzyGame", $controller);

        $_SESSION = [
            "key" => "value"
        ];

        $exp = "\Psr\Http\Message\ResponseInterface";
        $res = $controller->restart();
        $this->assertInstanceOf($exp, $res);
        $this->assertEmpty($_SESSION);
    }
}
