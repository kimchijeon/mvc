<?php

/**
* Yatzy index page view.
*/

declare(strict_types=1);

use function Mos\Functions\url;

$header = $header ?? null;
$message = $message ?? null;

?><h1><?= $header ?></h1>

<p><?= $message ?></p>

<form method="post" action="<?= url("/yatzy/process") ?>">
    <input type="hidden" name="round" value="1">
    <input type="submit" name="submit" value="Start Game!">
</form>