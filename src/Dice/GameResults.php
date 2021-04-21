<?php

declare(strict_types=1);

namespace Kimchi\Dice;

use Kimchi\Dice\Dice;
use Kimchi\Dice\Dicehand;

use function Mos\Functions\renderView;
use function Mos\Functions\url;

/**
 * Class GameResults as a controller class
 */
class GameResults
{
    public function showResults(): array
    {
        $data = [
            "header" => "Let's play 21",
            "message" => "If you get 21 you win! If you get more than 21 you lose."
        ];

        if (isset($_SESSION["dicetotal"])) {
            $diceSession = $_SESSION["dicetotal"];
        }

        $data["sumDice"] = 0;

        if (isset($diceSession)) {
            $data["sumDice"] = $diceSession;
        }

        $data["notice"] = "Keep rolling?";

        if (isset($diceSession) && $diceSession > 21) {
            $data["notice"] = "You lose!";
        } elseif (isset($diceSession) && $diceSession == 21) {
            $data["notice"] = "You win!";
        }

        $data["lastRoll"] = [0];

        if (isset($_SESSION["dicehand"])) {
            $data["lastRoll"] = $_SESSION["dicehand"];
        }

        return $data;
    }

    public function showFinalResults(): array
    {
        $data = [
            "header" => "Let's play 21",
            "message" => "Final results!",
        ];

        if (isset($_SESSION["playertotal"])) {
            $data["getPlayerTotal"] = $_SESSION["playertotal"];
        }

        if (isset($_SESSION["bottotal"])) {
            $data["getBotTotal"] = $_SESSION["bottotal"];
        }

        $data["getFinalResults"] = "";

        if (isset($_SESSION["playertotal"]) && $_SESSION["playertotal"] == 21) {
            $data["getFinalResults"] .= "You win!";
        } elseif (isset($_SESSION["playertotal"]) && $_SESSION["playertotal"] > 21) {
            $data["getFinalResults"] .= "You're both losers.";
        } elseif (isset($_SESSION["bottotal"]) && isset($_SESSION["playertotal"]) && $_SESSION["bottotal"] == $_SESSION["playertotal"]) {
            $data["getFinalResults"] .= "Bot wins!";
        } elseif (isset($_SESSION["bottotal"]) && isset($_SESSION["playertotal"]) && $_SESSION["bottotal"] > $_SESSION["playertotal"] && $_SESSION["bottotal"] <= 21) {
            $data["getFinalResults"] .= "Bot wins!";
        } elseif (isset($_SESSION["bottotal"]) && $_SESSION["bottotal"] > 21) {
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

        $data["getWins"] = 0;

        if (isset($_SESSION["wins"])) {
            $data["getWins"] = $_SESSION["wins"];
        }

        $data["getLosses"] = 0;

        if (isset($_SESSION["loss"])) {
            $data["getLosses"] = $_SESSION["loss"];
        }

        return $data;
    }
}
