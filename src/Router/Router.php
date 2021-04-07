<?php

declare(strict_types=1);

namespace Mos\Router;

use Kimchi\Dice\Game;

use function Mos\Functions\{
    destroySession,
    redirectTo,
    renderView,
    renderTwigView,
    sendResponse,
    url
};

/**
 * Class Router.
 */
class Router
{
    public static function dispatch(string $method, string $path): void
    {
        if ($method === "GET" && $path === "/") {
            $data = [
                "header" => "Index page",
                "message" => "Hello, this is the index page, rendered as a layout.",
            ];
            $body = renderView("layout/page.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session") {
            $body = renderView("layout/session.php");
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session/destroy") {
            destroySession();
            redirectTo(url("/session"));
            return;
        } else if ($method === "GET" && $path === "/debug") {
            $body = renderView("layout/debug.php");
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/twig") {
            $data = [
                "header" => "Twig page",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderTwigView("index.html", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/some/where") {
            $data = [
                "header" => "Rainbow page",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderView("layout/page.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/dice") {
            $callable = new Game();
            $callable->prepareGame();

            return;
        } else if ($method === "POST" && $path === "/game21-process") {
            $callable = new Game();
            $callable->setDiceNumber();

            return;
        } else if ($method === "GET" && $path === "/game21") {
            $callable = new Game();
            $callable->showResults();

            return;
        } else if ($method === "POST" && $path === "/game21-play") {
            $callable = new Game();
            $callable->playGame();

            return;
        } else if ($method === "GET" && $path === "/game21/restart") {
            destroySession();
            redirectTo(url("/dice"));

            return;
        } else if ($method === "POST" && $path === "/bot-game21-process") {
            $callable = new Game();
            $callable->savePlayerTotal();

            return;
        } else if ($method === "GET" && $path === "/bot-game21") {
            $callable = new Game();
            $callable->prepareBotGame();

            return;
        } else if ($method === "POST" && $path === "/bot-game21-play") {
            $callable = new Game();
            $callable->botRoll();

            return;
        } else if ($method === "GET" && $path === "/game21-results") {
            $callable = new Game();
            $callable->showFinalResults();

            return;
        }
        $data = [
            "header" => "404",
            "message" => "The page you are requesting is not here. You may also checkout the HTTP response code, it should be 404.",
        ];
        $body = renderView("layout/page.php", $data);
        sendResponse($body, 404);
    }
}
