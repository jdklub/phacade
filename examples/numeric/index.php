<?
require('../../phacade/phacade.control.php');
require('../../phacade/phacade.textbox.php');
require('../../phacade/phacade.numericvalidator.php');
require('../../phacade/phacade.button.php');


// create a Textbox to accept input
$txtNumber = new Textbox('number');

// create a NumericValidator and set the range of 
// acceptable values
$vdtRange = new NumericValidator(1, 100);
$vdtRange->min = 1;
$vdtRange->max = 100;

// attach the NumericValidator to the Textbox
$txtNumber->validator = $vdtRange;

// create a button
$btnCheck = new Button('check');
$btnCheck->submit = true;
$btnCheck->value = 'Check';

if ($btnCheck->clicked) {
    // see if the input is valid
    if ($txtNumber->valid()) {
        echo "Valid";
    } else {
        echo "Not Valid";
    }
}
?>

<form>
    Enter A Number Between 1 and 100: <?= $txtNumber ?><br>
    <?= $btnCheck ?>
</form>