<?php

declare(strict_types=1);

namespace Kimchi\Dice;

use Kimchi\Dice\Dice;
use Kimchi\Dice\Dicehand;

use function Mos\Functions\renderView;
use function Mos\Functions\url;

/**
 * Class Game as a controller class
 */
class Game
{
    public function setDiceNumber(): void
    {
        if (isset($_POST['submit'])) {
            $_SESSION["number"] = (int)$_POST['number'] ?? null;
        }
    }

    public function playGame(): void
    {
        $diceHand = new Dicehand();

        if (isset($_SESSION["number"])) {
            $diceHand->setNumber($_SESSION["number"]);
        }

        $diceHand->prepare();
        $diceHand->roll();

        $_SESSION["dicehand"] = $diceHand->getLastRoll();

        if (!isset($_SESSION["dicetotal"])) {
            $_SESSION["dicetotal"] = array_sum($_SESSION["dicehand"]);
        } elseif (isset($_SESSION["dicetotal"])) {
            $_SESSION["dicetotal"] = array_sum($_SESSION["dicehand"]) + ($_SESSION["dicetotal"]);
        }
    }

    public function savePlayerTotal(): void
    {
        if (isset($_POST['submit'])) {
            $_SESSION["playertotal"] = (int)$_POST['playerdice'] ?? null;
        }
    }

    public function prepareBotGame(): array
    {
        $data = [
            "header" => "Let's play 21",
            "message" => "It's the bot's turn to play. Who will win?",
        ];

        if (isset($_SESSION["playertotal"])) {
            $data["getPlayerTotal"] = $_SESSION["playertotal"];
        }

        return $data;
    }

    public function botRoll(): void
    {
        $botHand = new Dice();

        //Bot will roll until it has a higher or equal number to player.
        if (isset($_SESSION["playertotal"]) && !isset($_SESSION["bottotal"])) {
            $_SESSION["bottotal"] = $botHand->roll();
        }

        while (isset($_SESSION["playertotal"]) && $_SESSION["bottotal"] < $_SESSION["playertotal"]) {
            $botHand->roll();

            $_SESSION["bothand"] = $botHand->getLastRoll();

            $_SESSION["bottotal"] = $_SESSION["bothand"] + ($_SESSION["bottotal"]);
        }
    }

    public function prepareGame(): void
    {
        if (isset($_SESSION["number"])) {
            $_SESSION["number"] = null;
        }

        if (isset($_SESSION["dicehand"])) {
            $_SESSION["dicehand"] = null;
        }

        if (isset($_SESSION["dicetotal"])) {
            $_SESSION["dicetotal"] = null;
        }

        if (isset($_SESSION["playertotal"])) {
            $_SESSION["playertotal"] = null;
        }

        if (isset($_SESSION["bothand"])) {
            $_SESSION["bothand"] = null;
        }

        if (isset($_SESSION["bottotal"])) {
            $_SESSION["bottotal"] = null;
        }
    }
}
