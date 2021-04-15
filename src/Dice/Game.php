<?php

declare(strict_types=1);

namespace Kimchi\Dice;

use Kimchi\Dice\Dice;
use Kimchi\Dice\Dicehand;
use Kimchi\Dice\GraphicalDice;

use function Mos\Functions\{
    redirectTo,
    renderView,
    sendResponse,
    url
};

/**
 * Class Game as a controller class
 */
class Game
{
    private ?array $diceSession;
    private int $lastRoll;
    private int $playerTotal;
    private ?array $botTotal;

    public function setDiceNumber(): void
    {
        if (isset($_POST['submit'])) {
            $_SESSION["number"] = (int)$_POST['number'] ?? null;
        }

        if ($_SESSION["number"] == null) {
            redirectTo(url("/game21"));
        }
    }

    public function playGame(): void
    {
        $diceHand = new Dicehand();

        if (isset($_SESSION["number"])) {
            $number = $_SESSION["number"];
        } else {
            redirectTo(url("/game21"));
        }

        if (isset($number)) {
            $diceHand->setNumber($number);
        }

        $diceHand->prepare();
        $diceHand->roll();

        $_SESSION["dicehand"] = $diceHand->getLastRoll();

        if (!isset($_SESSION["dicetotal"])) {
            $_SESSION["dicetotal"] = array_sum($_SESSION["dicehand"]);
        } else {
            $_SESSION["dicetotal"] = array_sum($_SESSION["dicehand"]) + ($_SESSION["dicetotal"]);
        }
    }

    public function showResults(): array
    {
        $data = [
            "header" => "Let's play 21",
            "message" => "If you get 21 you win! If you get more than 21 you lose."
        ];

        if (isset($_SESSION["dicetotal"])) {
            $diceSession = $_SESSION["dicetotal"];
        }

        if (isset($diceSession)) {
            $data["sumDice"] = $diceSession;
        } else {
            $data["sumDice"] = 0;
        }

        $data["notice"] = "";

        if (isset($diceSession) && $diceSession > 21) {
            $data["notice"] .= "You lose!";
        } elseif (isset($diceSession) && $diceSession == 21) {
            $data["notice"] .= "You win!";
        } else {
            $data["notice"] .= "Keep rolling?";
        }

        if (isset($_SESSION["dicehand"])) {
            $lastRoll = $_SESSION["dicehand"];
        }

        $noRoll = [0];

        if (isset($lastRoll)) {
            $data["lastRoll"] = $lastRoll;
        } else {
            $data["lastRoll"] = $noRoll;
        }

        return $data;
    }

    public function savePlayerTotal(): void
    {
        if (isset($_POST['submit'])) {
            $_SESSION["playertotal"] = (int)$_POST['playerdice'] ?? null;
        }

        if ($_SESSION["playertotal"] == null) {
            redirectTo(url("/game21/game"));
        }
    }

    public function prepareBotGame(): array
    {
        $data = [
            "header" => "Let's play 21",
            "message" => "It's the bot's turn to play. Who will win?",
        ];

        if (isset($_SESSION["playertotal"])) {
            $playerTotal = $_SESSION["playertotal"];
        }

        if (isset($playerTotal)) {
            $data["getPlayerTotal"] = $playerTotal;
        } else {
            redirectTo(url("/game21/game"));
        }

        return $data;
    }

    public function botRoll(): void
    {
        $botHand = new Dice();

        if (isset($_SESSION["playertotal"])) {
            $playerTotal = $_SESSION["playertotal"];
        }

        //Bot will roll until it has a higher number than player.
        if (isset($playerTotal) && !isset($_SESSION["bottotal"])) {
            $_SESSION["bottotal"] = $botHand->roll();
        }

        while (isset($playerTotal) && $_SESSION["bottotal"] < $playerTotal) {
            $botHand->roll();

            $_SESSION["bothand"] = $botHand->getLastRoll();

            $_SESSION["bottotal"] = $_SESSION["bothand"] + ($_SESSION["bottotal"]);
        }
    }

    public function showFinalResults(): array
    {
        $data = [
            "header" => "Let's play 21",
            "message" => "Final results!",
        ];

        if (isset($_SESSION["playertotal"])) {
            $playerTotal = $_SESSION["playertotal"];
        }

        if (isset($playerTotal)) {
            $data["getPlayerTotal"] = $playerTotal;
        }

        if (isset($_SESSION["bottotal"])) {
            $botTotal = $_SESSION["bottotal"];
        }

        if (isset($botTotal)) {
            $data["getBotTotal"] = $botTotal;
        } else {
            $data["getBotTotal"] = "There has been some error. Try again!";
        }

        $data["getFinalResults"] = "";

        if (isset($botTotal) && isset($playerTotal) && $botTotal == $playerTotal) {
            $data["getFinalResults"] .= "Bot wins!";
        } elseif (isset($botTotal) && isset($playerTotal) && $botTotal > $playerTotal && $botTotal <= 21) {
            $data["getFinalResults"] .= "Bot wins!";
        } elseif (isset($playerTotal) && $playerTotal > 21) {
            $data["getFinalResults"] .= "You're both losers.";
        } elseif (isset($botTotal) && $botTotal > 21) {
            $data["getFinalResults"] .= "You win!";
        } elseif (isset($botTotal) && isset($playerTotal) && $botTotal < $playerTotal) {
            $data["getFinalResults"] .= "You win!";
        } elseif (isset($playerTotal) && $playerTotal == 21) {
            $data["getFinalResults"] .= "You win!";
        }

        if (!isset($_SESSION["wins"]) && $data["getFinalResults"] == "You win!") {
            $_SESSION["wins"] = 1;
        } elseif (isset($_SESSION["wins"]) && $data["getFinalResults"] == "You win!") {
            $_SESSION["wins"] += 1;
        } elseif (!isset($_SESSION["loss"]) && $data["getFinalResults"] == "Bot wins!") {
            $_SESSION["loss"] = 1;
        } elseif (isset($_SESSION["loss"]) && $data["getFinalResults"] == "Bot wins!") {
            $_SESSION["loss"] += 1;
        }

        if (isset($_SESSION["wins"])) {
            $data["getWins"] = $_SESSION["wins"];
        } else {
            $data["getWins"] = 0;
        }

        if (isset($_SESSION["loss"])) {
            $data["getLosses"] = $_SESSION["loss"];
        } else {
            $data["getLosses"] = 0;
        }

        return $data;
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
