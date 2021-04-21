<?php

declare(strict_types=1);

namespace Kimchi\Dice;

use Kimchi\Dice\Dice;
use Kimchi\Dice\Dicehand;

use function Mos\Functions\renderView;
use function Mos\Functions\url;
use function Mos\Functions\sumDiceValue;

/**
 * Class Yatzy
 */
class Yatzy
{
    public function prepareRound(): void
    {
        if (isset($_POST["submit"])) {
            $_SESSION["round"] = (int)$_POST["round"] ?? null;
        }

        if (isset($_SESSION["restdices"])) {
            $_SESSION["restdices"] = null;
        }
    }

    public function showRound(): array
    {
        $data = [
            "header" => "Yatzy Lite",
            "message" => "Collect as many dice for this round as possible."
        ];

        //Show which round it is
        if (isset($_SESSION["round"])) {
            $data["round"] = $_SESSION["round"];
        }

        return $data;
    }

    public function firstDiceRoll(): void
    {
        $diceHand = new Dicehand();
        $diceHand->setNumber(4);
        $diceHand->prepare();
        $diceHand->roll();

        $_SESSION["lastroll"] = $diceHand->getLastRoll();

        $diceHand->saveDice();
    }

    public function anotherDiceRoll(): void
    {
        $diceHand = new Dicehand();

        foreach ($_SESSION["wantedvalues"] as $key) {
            $_SESSION["restdices"][] = $_SESSION["lastroll"][$key];
        }

        $number = 4;

        if (isset($_SESSION["restdices"])) {
            $restDices = count($_SESSION["restdices"]);
            $number = 4 - $restDices;
        }

        $diceHand->setNumber($number);
        $diceHand->prepare();
        $diceHand->roll();

        $_SESSION["lastroll"] = $diceHand->getLastRoll();

        $diceHand->saveDice();
    }

    public function showResults(): array
    {
        $data = [
            "header" => "Yatzy Lite",
            "message" => "Collect as many dice for this round as possible."
        ];

        //Show which round it is
        if (isset($_SESSION["round"])) {
            $data["round"] = $_SESSION["round"];
        }

        //Sum of only a certain value
        if (isset($_SESSION["saveddices"])) {
            $getWantedValues = array_keys($_SESSION["saveddices"], $_SESSION["round"]);
        }

        $sumValues = 0;

        if (isset($_SESSION["saveddices"]) && isset($getWantedValues)) {
            foreach ($getWantedValues as $key) {
                $sumValues += $_SESSION["saveddices"][$key];
            }
        }

        $data["sumValues"] = $sumValues;

        //Show last roll
        if (isset($_SESSION["lastroll"])) {
            $lastRoll = $_SESSION["lastroll"];
            $data["lastRoll"] = $lastRoll;
        }

        return $data;
    }

    public function showEndResults(): array
    {
        $data = [
            "header" => "Yatzy Lite",
            "message" => "How did it go?"
        ];

        //Export $_SESSION["savedDices"] array to $data
        $savedDices = $_SESSION["saveddices"];
        $data["savedDices"] = $savedDices;

        //Sum of only a certain value
        $data["sumOnes"] = sumDiceValue($savedDices, 1);
        $data["sumTwos"] = sumDiceValue($savedDices, 2);
        $data["sumThrees"] = sumDiceValue($savedDices, 3);
        $data["sumFours"] = sumDiceValue($savedDices, 4);
        $data["sumFives"] = sumDiceValue($savedDices, 5);
        $data["sumSixes"] = sumDiceValue($savedDices, 6);

        //Total sum:
        if (isset($_SESSION["saveddices"])) {
            $data["sumDice"] = array_sum($_SESSION["saveddices"]);
        }

        return $data;
    }
}
