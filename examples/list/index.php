<?
require('../../phacade/phacade.control.php');
require('../../phacade/phacade.button.php');
require('../../phacade/phacade.listbox.php');

// create a new Listbox, allow for multiple selections
$lstColors = new Listbox('colors');
$lstColors->size = 10;
$lstColors->multiple = true;

// add an item to the Listobox, defining the key and item
$lstColors->add('bl', 'blue');

// add several items to the Listbox using an array
$colors = array('yel' => 'yellow', 'r' => 'red');
$lstColors->addItems($colors);

// add several items to the Listbox, including
// an array that contains an array
$shapes = array('circ' => 'circle', 'sq' => 'square', 'tri' => 'triangle');
$more_colors = array('gre' => 'green', 'shp' => $shapes, 'br' => 'brown');
$lstColors->addItems($more_colors);

// add an item -- without defining a key
$lstColors->add('purple');

// create simple Button
$btnSubmit = new Button('action');
$btnSubmit->value = 'Choose!';
$btnSubmit->submit = true;

if ($btnSubmit->clicked) {
    echo 'You choose: ';
    foreach ($lstColors->selected as $key => $value) {
        echo $lstColors->items[$value] . ' ';
    }
}

?>

<br>
Select the color(s) you want below.
<form method="post">
    <?= $lstColors ?>
    <br>
    <?= $btnSubmit ?>
</form>