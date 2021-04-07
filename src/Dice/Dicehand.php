<?php

declare(strict_types=1);

namespace Kimchi\Dice;

/**
 * Class Dicehand.
 */
class Dicehand
{
    private array $dices;
    private int $sum;
    private int $number;

    /**
     * Set the number of dice.
     *
     * @param int $number The number of dice.
     *
     * @return void
     */
    public function setNumber(int $number)
    {
        $this->number = $number;
    }

    /**
     * Get the number of dice.
     *
     * @return int as the number of the dice.
     */
    public function getNumber()
    {
        return $this->number;
    }

    public function prepare()
    {
        for ($i = 0; $i <= $this->number; $i++) {
            $this->dices[$i] = new Dice();
        }
    }

    public function roll(): void
    {
        $this->sum = 0; //Save the sum of the dice hand

        for ($i = 0; $i <= $this->number; $i++) {
            $this->sum += $this->dices[$i]->roll(); //Throw the dices and calculate the sum
        }
    }

    public function getLastRoll(): array
    {
        $res = "";

        for ($i = 0; $i <= $this->number; $i++) {
            $res .= $this->dices[$i]->getLastRoll() . ",";
        }

        $resArray = array_map('intval', explode(",", rtrim($res, ',')));
        return $resArray;
    }
}
