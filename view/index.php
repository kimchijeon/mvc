<?php

/**
 * Index page.
 */

declare(strict_types=1);

use function Mos\Functions\url;

?>

<h1>Welcome to this page!</h1>

<p>This website was made for course <a href="https://dbwebb.se/kurser/mvc-v1">dbwebb-mvc</a> in April/May 2021.</p>

<h2>What would you like to do today?</h2>
<ul>
    <li><a href="<?= url("/session") ?>">Session Management</a></li>
    <li><a href="<?= url("/game21") ?>">Play Game 21</a></li>
    <li><a href="<?= url("/yatzy") ?>">Play Yatzy</a></li>
</ul>