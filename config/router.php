<?php

/**
 * Load the routes into the router, this file is included from
 * `htdocs/index.php` during the bootstrapping to prepare for the request to
 * be handled.
 */

declare(strict_types=1);

use FastRoute\RouteCollector;

$router = $router ?? null;

$router->addRoute("GET", "/test", function () {
    // A quick and dirty way to test the router or the request.
    return "Testing response";
});

$router->addRoute("GET", "/", "\Mos\Controller\Index");
$router->addRoute("GET", "/debug", "\Mos\Controller\Debug");
$router->addRoute("GET", "/twig", "\Mos\Controller\TwigView");

$router->addGroup("/session", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\Mos\Controller\Session", "index"]);
    $router->addRoute("GET", "/destroy", ["\Mos\Controller\Session", "destroy"]);
});

$router->addGroup("/some", function (RouteCollector $router) {
    $router->addRoute("GET", "/where", ["\Mos\Controller\Sample", "where"]);
});

$router->addGroup("/form", function (RouteCollector $router) {
    $router->addRoute("GET", "/view", ["\Mos\Controller\Form", "view"]);
    $router->addRoute("POST", "/process", ["\Mos\Controller\Form", "process"]);
});

$router->addGroup("/game21", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\Kimchi\Controller\Game21", "index"]);
    $router->addRoute("POST", "/process", ["\Kimchi\Controller\Game21", "setDiceProcess"]);
    $router->addRoute("GET", "/game", ["\Kimchi\Controller\Game21", "game"]);
    $router->addRoute("POST", "/play", ["\Kimchi\Controller\Game21", "play"]);
    $router->addRoute("POST", "/bot/process", ["\Kimchi\Controller\Game21", "botProcess"]);
    $router->addRoute("GET", "/bot/game", ["\Kimchi\Controller\Game21", "botGame"]);
    $router->addRoute("POST", "/bot/play", ["\Kimchi\Controller\Game21", "botPlay"]);
    $router->addRoute("GET", "/result", ["\Kimchi\Controller\Game21", "result"]);
    $router->addRoute("GET", "/restart", ["\Kimchi\Controller\Game21", "restart"]);
});

$router->addGroup("/yatzy", function (RouteCollector $router) {
    $router->addRoute("GET", "", ["\Kimchi\Controller\YatzyGame", "index"]);
    $router->addRoute("POST", "/process", ["\Kimchi\Controller\YatzyGame", "setRoundProcess"]);
    $router->addRoute("GET", "/game", ["\Kimchi\Controller\YatzyGame", "game"]);
    $router->addRoute("POST", "/roll/1", ["\Kimchi\Controller\YatzyGame", "firstRoll"]);
    $router->addRoute("GET", "/game/firstroll", ["\Kimchi\Controller\YatzyGame", "gameFirstRoll"]);
    $router->addRoute("POST", "/roll/2", ["\Kimchi\Controller\YatzyGame", "secondRoll"]);
    $router->addRoute("GET", "/game/secondroll", ["\Kimchi\Controller\YatzyGame", "gameSecondRoll"]);
    $router->addRoute("POST", "/roll/3", ["\Kimchi\Controller\YatzyGame", "thirdRoll"]);
    $router->addRoute("GET", "/game/thirdroll", ["\Kimchi\Controller\YatzyGame", "gameThirdRoll"]);
    $router->addRoute("GET", "/round-end", ["\Kimchi\Controller\YatzyGame", "roundEndResults"]);
    $router->addRoute("GET", "/restart", ["\Kimchi\Controller\YatzyGame", "restart"]);
});
