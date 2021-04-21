<?php

namespace Kimchi\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for trait SaveDiceTrait.
 */
class SaveDiceTraitTest extends TestCase
{
    /**
     * Verify that if the round is 3 and the lastroll contains
     * two threes, these threes will be saved in $_SESSION["saveddices"].
     */
    public function testSaveDiceTrait()
    {
        $_SESSION["round"] = 3;
        $_SESSION["lastroll"] = array(1, 3, 3, 4, 6);

        $mock = $this->getMockForTrait(SaveDiceTrait::class);

        $mock->saveDice();

        $res = $_SESSION["saveddices"];
        $this->assertContains(3, $res);
    }
}
