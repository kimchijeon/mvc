<?php

declare(strict_types=1);

namespace Kimchi\Dice;

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
}
