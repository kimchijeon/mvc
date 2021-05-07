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

<p>You rolled and got:</p>

<div class="dice-utf8">
<?php foreach ($lastRoll as $value) : ?>
    <div class="dice-<?= $value ?>"></div>
<?php endforeach; ?>
</div>

<p>Current total: <?= $sumDice ?></p>

<p><?= $notice ?></p>
<p>
    <form method="post" action="<?= url("/game21/play") ?>">
        <input type="submit" name="submit" value="Roll dice">
    </form>
</p>
<p>
    <form method="post" action="<?= url("/game21/bot/process") ?>">
        <input type="hidden" name="playerdice" value="<?= $sumDice ?>">
        <input type="submit" name="submit" value="Stop rolling">
    </form>
</p>
<p>
    <button><a href="<?= url("/game21") ?>">Restart</a></button>
</p>