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

<p>Your total: <?= $getPlayerTotal ?></p>
<p>Bot total: <?= $getBotTotal ?></p>

<p><?= $getResultMessage ?></p>

<h2>Scoreboard</h2>
<p>Total rounds: <?= $getWins + $getLosses?></p>
<p>You have won <?= $getWins ?> times.</p>
<p>Bot has won <?= $getLosses ?> times.</p>
<p>
    <button><a href="<?= url("/game21") ?>">Play another round</a></button>
</p>
<p>
    <button><a href="<?= url("/game21/restart") ?>">Reset scoreboard</a></button>
</p>