<?php
require('../../phacade/phacade.control.php');
require('../../phacade/phacade.listbox.php');
require('../../phacade/phacade.button.php');
require('custom.picker.php');

$pckColors = new Picker('picker');
$pckColors->size = 10;
$pckColors->addItems(array('yel' => 'yellow', 'r' => 'red', 'blu' => 'blue', 'gre' => 'green', 'or' => 'orange'));

?>

Move the items you want to the left. Get rid of items by moving them to the right.
<form method="post">
<?= $pckColors ?>
</form>

