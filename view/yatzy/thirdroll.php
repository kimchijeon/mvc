<?php

/**
* Yatzy view template to generate a Yatzy web page.
*/

declare(strict_types=1);

use function Mos\Functions\url;

$header = $header ?? null;
$message = $message ?? null;

?><h1><?= $header ?></h1>

<p><?= $message ?></p>

<h2>Currently playing round <?= $round ?>.</h2>

<p>You rolled and got:</p>

<div class="dice-utf8">
<?php foreach ($lastRoll as $value) : ?>
    <div class="dice-<?= $value ?>"></div>
<?php endforeach; ?>
</div>

<p>Current total: <?= $sumValues ?></p>

<p>
    <button><a href="<?= url("/yatzy/round-end") ?>">Show results</a></button>
</p>
<p>
    <button><a href="<?= url("/yatzy/restart") ?>">Reset</a></button>
</p>