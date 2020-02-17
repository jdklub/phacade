<?php
require('../../phacade/phacade.control.php');
require('../../phacade/phacade.textbox.php');
require('../../phacade/phacade.button.php');
require('../../phacade/phacade.numericvalidator.php');
require('../../phacade/phacade.multiplevalidator.php');
require('custom.evenvalidator.php');


// Textbox for entering data
$txtNumber = new Textbox('number');

// make sure it is no greater than 100
$vldTop = new NumericValidator();
$vldTop->max = 100;

// make sure it is no less than 0;
$vldBottom = new NumericValidator();
$vldBottom->min = 0;

// make sure it is divisible by two
$vldEven = new EvenValidator();

// groups all the Validators together
$vldAll = new MultipleValidator($vldTop, $vldBottom, $vldEven);

// attach the Validators to the TextBox
$txtNumber->validator = $vldAll;

// submit button
$btnCheck = new Button('check');
$btnCheck->submit = true;
$btnCheck->value = 'Check It!';

if ($btnCheck->clicked) {
    if ($txtNumber->valid()) {
        echo "Valid";
    } else {
        echo "Not Valid";
    }
}

?>

<form method="post">
    You input will be checked against three Validators: > 0, < 100, Even<br>
    Enter a number between 1 and 100: <?= $txtNumber ?><br>
    <?= $btnCheck ?>

</form>