<?php

declare(strict_types=1);

namespace Kimchi\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Kimchi\Dice\Yatzy;

use function Mos\Functions\renderView;
use function Mos\Functions\url;
use function Mos\Functions\destroySession;

/**
 * Controller for Yatzy routes.
 */
class YatzyGame
{
    public function index(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $data = [
            "header" => "Yatzy Lite",
            "message" => "Collect Ones, Twos, Threes, Fours and Sixes and score as high a sum as possible.
            <p> If you get a sum of at least 63 you get a 50 point bonus!</p>",
        ];

        $body = renderView("layout/yatzy-index.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function setRoundProcess(): ResponseInterface
    {
        $callable = new Yatzy();
        $callable->prepareRound();

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/yatzy/game"));
    }

    public function game(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $callable = new Yatzy();
        $data = $callable->showRound();

        $body = renderView("layout/yatzy-game.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function firstRoll(): ResponseInterface
    {
        $callable = new Yatzy();
        $callable->firstDiceRoll();

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/yatzy/game/firstroll"));
    }

    public function gameFirstRoll(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $callable = new Yatzy();
        $data = $callable->showResults();

        $body = renderView("layout/yatzy-firstroll.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function secondRoll(): ResponseInterface
    {
        $callable = new Yatzy();
        $callable->anotherDiceRoll();

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/yatzy/game/secondroll"));
    }

    public function gameSecondRoll(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $callable = new Yatzy();
        $data = $callable->showResults();

        $body = renderView("layout/yatzy-secondroll.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function thirdRoll(): ResponseInterface
    {
        $callable = new Yatzy();
        $callable->anotherDiceRoll();

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/yatzy/game/thirdroll"));
    }

    public function gameThirdRoll(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $callable = new Yatzy();
        $data = $callable->showResults();

        $body = renderView("layout/yatzy-thirdroll.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function roundEndResults(): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        $callable = new Yatzy();
        $data = $callable->showEndResults();

        $body = renderView("layout/yatzy-round.php", $data);

        return $psr17Factory
            ->createResponse(200)
            ->withBody($psr17Factory->createStream($body));
    }

    public function restart(): ResponseInterface
    {
        destroySession();

        return (new Response())
            ->withStatus(301)
            ->withHeader("Location", url("/yatzy"));
    }
}
