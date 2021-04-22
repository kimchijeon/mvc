<?php

declare(strict_types=1);

namespace Kimchi\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Kimchi\Dice\Game;
use Kimchi\Dice\GameResults;

use function Mos\Functions\renderView;
use function Mos\Functions\url;
use function Mos\Functions\destroySession;

/**
 * Controller for the Game 21 routes.
 */
class Game21
{
    public function index(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $data = [
            "header" => "Let's play 21",
            "message" => "Can you beat me in a game of 21?",
        ];

        $callable = new Game();
        $callable->prepareGame();

        $body = renderView("layout/game21-index.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function game(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $callable = new GameResults();
        $data = $callable->showResults();

        $body = renderView("layout/game21.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function setDiceProcess(): ResponseInterface
    {
        $callable = new Game();
        $callable->setDiceNumber();

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/game21/game"));
    }

    public function play(): ResponseInterface
    {
        $callable = new Game();
        $callable->playGame();

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/game21/game"));
    }

    public function botProcess(): ResponseInterface
    {
        $callable = new Game();
        $callable->savePlayerTotal();

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/game21/bot/game"));
    }

    public function botGame(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $callable = new Game();
        $data = $callable->prepareBotGame();

        $body = renderView("layout/bot-game21.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function botPlay(): ResponseInterface
    {
        $callable = new Game();
        $callable->botRoll();

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/game21/result"));
    }

    public function result(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $callable = new GameResults();
        $data = $callable->showFinalResults();

        $body = renderView("layout/game21-results.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function restart(): ResponseInterface
    {
        destroySession();

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/game21"));
    }
}
