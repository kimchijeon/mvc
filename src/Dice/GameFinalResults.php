<?php

declare(strict_types=1);

namespace Kimchi\Dice;

/**
 * Class GameFinalResults as a controller class
 */
class GameFinalResults
{
    private $message;

    public function setTotals(): array
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

        return $data;
    }

    public function showFinalResults(): array
    {
        $data = [];

        $playertotal = $_SESSION["playertotal"];
        $bottotal = $_SESSION["bottotal"];

        $this->message = "";

        if ($playertotal > 21) {
            $this->message .= "You're both losers.";
        } elseif ($playertotal == 21 || $bottotal > 21) {
            $this->message .= "You win!";
        } elseif ($bottotal == $playertotal || $bottotal > $playertotal && $bottotal <= 21) {
            $this->message .= "Bot wins!";
        }

        $data["getResultMessage"] = $this->message;

        return $data;
    }

    public function showScoreboard(): array
    {
        $data = [];

        if (!isset($_SESSION["win"])) {
            $_SESSION["win"] = 0;
        }

        if (!isset($_SESSION["loss"])) {
            $_SESSION["loss"] = 0;
        }

        if ($this->message == "You win!") {
            $_SESSION["win"] += 1;
        } elseif ($this->message == "Bot wins!") {
            $_SESSION["loss"] += 1;
        }

        $data["getWins"] = 0;

        if (isset($_SESSION["win"])) {
            $data["getWins"] = $_SESSION["win"];
        }

        $data["getLosses"] = 0;

        if (isset($_SESSION["loss"])) {
            $data["getLosses"] = $_SESSION["loss"];
        }

        return $data;
    }
}
