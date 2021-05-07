<?php

/**
* Yatzy game current result page.
*/

declare(strict_types=1);

use function Mos\Functions\url;

$header = $header ?? null;
$message = $message ?? null;

?><h1><?= $header ?></h1>

<p><?= $message ?></p>

<h2>Currently playing round <?= $round ?>.</h2>

<p>
    <form method="post" action="<?= url("/yatzy/roll/1") ?>">
        <input type="submit" name="submit" value="Roll dice">
    </form>
</p>
<p>
    <button><a href="<?= url("/yatzy/restart") ?>">Reset</a></button>
</p>