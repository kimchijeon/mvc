Pseudo code Yatzy-class
============================

## Method for rolling initial 5 dice
Instantiate `new DiceHand` as `$diceHand`.

Set number of dices to `5`.

Prepare a new set of dice to be saved in `$dices` array.

Roll `$diceHand`.


## Method for saving dices (same for each round)
Get the last roll, return `$resArray` with dice values as integers.

Declare `$lastRoll` with value `$resArray`.

Find all the keys with the wanted value from `$lastRoll` and save them in `$_SESSION["wantedvalues"]`.

For each key in `$_SESSION["wantedvalues"]`,
    save dices with wanted value in `$_SESSION["saveddices"]` array.

Sum values of `$_SESSION["saveddices"]` and store in `$data` to export to view.


## Method for re-rolling the rest of the dices
Instantiate `new DiceHand` as `$diceHand`.

For each key in `$_SESSION["wantedvalues"]`,
    save dices with wanted value in `$_SESSION["restdices"]` array.

Count number of elements in `$_SESSION["restdices"]` and save in variable `$restDices`.

Set number of dices to `5 - $restDices`.

Prepare a new set of dice to be saved in `$dices` array.

Roll `$diceHand`.
