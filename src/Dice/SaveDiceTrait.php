<?php

declare(strict_types=1);

namespace Kimchi\Dice;

trait SaveDiceTrait
{
    public function saveDice(): void
    {
        if (isset($_SESSION["round"])) {
            $round = $_SESSION["round"];
        }

        if (isset($round)) {
            $_SESSION["wantedvalues"] = array_keys($_SESSION["lastroll"], $round);
        }

        foreach ($_SESSION["wantedvalues"] as $key) {
            $_SESSION["saveddices"][] = $_SESSION["lastroll"][$key];
        }
    }
}
