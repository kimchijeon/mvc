<?php

/**
* Dice view template to generate a dice web page.
*/

declare(strict_types=1);

use function Mos\Functions\url;

$header = $header ?? null;
$message = $message ?? null;

?><h1><?= $header ?></h1>

<p><?= $message ?></p>

<form method="post" action="<?= url("/game21-process") ?>">
    <label>How many dice do you want to play with?</label>
    <select required name="number">
        <option value="0">1</option>
        <option value="1">2</option>
    </select>

    <input type="submit" name="submit" value="Play!">
</form>