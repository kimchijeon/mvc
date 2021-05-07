<?php

/**
* View for choosing a round in Yatzy.
*/

declare(strict_types=1);

use function Mos\Functions\url;

$header = $header ?? null;
$message = $message ?? null;

?><h1><?= $header ?></h1>

<p><?= $message ?></p>

<table>
  <tr>
    <th>Row</th>
    <th>Points</th>
  </tr>
  <tr>
    <td>Ones</td>
    <td><?= $sumOnes ?></td>
  </tr>
  <tr>
    <td>Twos</td>
    <td><?= $sumTwos ?></td>
  </tr>
  <tr>
    <td>Threes</td>
    <td><?= $sumThrees ?></td>
  </tr>
  <tr>
    <td>Fours</td>
    <td><?= $sumFours ?></td>
  </tr>
  <tr>
    <td>Fives</td>
    <td><?= $sumFives ?></td>
  </tr>
  <tr>
    <td>Sixes</td>
    <td><?= $sumSixes ?></td>
  </tr>
  <tr>
    <td><b>Sum:</b></td>
    <td><?= $sumDice ?></td>
  </tr>
  <tr>
    <td><b>Bonus:</b></td>
    <td>
    <?php
    if ($sumDice >= 63) {
        $bonus = 50;
        echo $bonus;
    } else {
        $bonus = 0;
        echo $bonus;
    };
    ?>
    </td>
  </tr>
  <tr>
    <td><b>Total:</b></td>
    <td><?= $sumDice + $bonus ?></td>
  </tr>
</table>

<h2>Round ended.</h2>
<form method="post" action="<?= url("/yatzy/process") ?>">
    <label>Choose a round you haven't played yet:</label>
    <select required name="round">
        <option value="">Choose round</option>
        <option value="2">Twos</option>
        <option value="3">Threes</option>
        <option value="4">Fours</option>
        <option value="5">Fives</option>
        <option value="6">Sixes</option>
    </select>
    <input type="submit" name="submit" value="Play!">
</form>

<p>
    Or end the game and start over: <button><a href="<?= url("/yatzy/restart") ?>">Reset</a></button>
</p>
