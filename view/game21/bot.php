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

<p>
    <form method="post" action="<?= url("/game21/bot/play") ?>">
        <input type="submit" name="submit" value="Let bot play">
    </form>
</p>