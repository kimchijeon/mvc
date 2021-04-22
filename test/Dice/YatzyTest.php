<?php

namespace Kimchi\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Yatzy.
 */
class YatzyTest extends TestCase
{
    /**
     * Construct object and verify that the object is of the correct class.
     */
    public function testCreateYatzyObject()
    {
        $yatzy = new Yatzy();
        $this->assertInstanceOf("\Kimchi\Dice\Yatzy", $yatzy);
    }

    /**
     * Verify that the posted round is the same round saved in the session.
     */
    public function testYatzySetRound()
    {
        $yatzy = new Yatzy();

        $_POST["submit"] = "Start game!";
        $_POST["round"] = 1;

        $yatzy->prepareRound();

        $res = $_SESSION["round"];
        $this->assertEquals(1, $res);
    }

    /**
     * Verify that if prepareRound() is called, $_SESSION["restdices"] is
     * nullified correctly.
     */
    public function testYatzyNullifyRestDices()
    {
        $yatzy = new Yatzy();

        $_SESSION["restdices"] = array(1, 1, 1);

        $yatzy->prepareRound();

        $this->assertEmpty($_SESSION["restdices"]);
    }

    /**
     * Verify that if $_SESSION["round"] is set it is equal to $data["round"].
     */
    public function testYatzyShowRound()
    {
        $yatzy = new Yatzy();

        $_SESSION["round"] = 2;

        $data = $yatzy->showRound();

        $res = $data["round"];
        $this->assertEquals(2, $res);
    }

    /**
     * Verify that firstDiceRoll() creates an array called $_SESSION["lastroll"]
     * with five dices.
     */
    public function testYatzyFirstDiceRoll()
    {
        $yatzy = new Yatzy();

        $yatzy->firstDiceRoll();

        $this->assertIsArray($_SESSION["lastroll"]);
        $this->assertCount(5, $_SESSION["lastroll"]);
    }

    /**
     * Verify that anotherDiceRoll() creates an array called $_SESSION["lastroll"]
     * containing three dices since two has been removed since first roll.
     */
    public function testYatzyAnotherDiceRoll()
    {
        $yatzy = new Yatzy();

        $_SESSION["wantedvalues"] = array(1, 3);

        $yatzy->anotherDiceRoll();

        $this->assertIsArray($_SESSION["lastroll"]);
        $this->assertCount(3, $_SESSION["lastroll"]);
    }

    /**
     * Verify that showResults() generates $data["sumValues"] correctly
     * according to what is set in $_SESSION["round"] and $_SESSION["saveddices].
     */
    public function testYatzyShowResults()
    {
        $yatzy = new Yatzy();

        $_SESSION["round"] = 2;
        $_SESSION["saveddices"] = [1, 2, 2, 3];

        $data = $yatzy->showResults();

        $res = $data["sumValues"];
        $this->assertEquals(4, $res);
    }

    /**
     * Verify that sum of each dice number is correct.
     */
    public function testYatzyShowEndResultsSumDiceValue()
    {
        $yatzy = new Yatzy();

        $_SESSION["saveddices"] = array(1, 1, 2, 2, 3, 3, 4, 4, 5, 5, 6, 6);

        $data = $yatzy->showEndResults();

        $this->assertEquals(2, $data["sumOnes"]);
        $this->assertEquals(4, $data["sumTwos"]);
        $this->assertEquals(6, $data["sumThrees"]);
        $this->assertEquals(8, $data["sumFours"]);
        $this->assertEquals(10, $data["sumFives"]);
        $this->assertEquals(12, $data["sumSixes"]);
    }

    /**
     * Verify that if $_SESSION["saveddices"] is set $data["sumDice"] is the sum of
     * $_SESSION["saveddices"].
     */
    public function testYatzyShowEndResultsSumDice()
    {
        $yatzy = new Yatzy();

        $_SESSION["saveddices"] = array(1, 2, 2, 5); //10

        $data = $yatzy->showEndResults();

        $res = $data["sumDice"];
        $this->assertEquals(10, $res);
    }
}
