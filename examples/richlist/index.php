<?
require('../../phacade/phacade.control.php');
require('../../phacade/phacade.button.php');
require('../../phacade/phacade.richlistbox.php');

// Create a RichListbox
$lstPeople = new RichListbox('people');
$lstPeople->multiple = true;

// Add several people. Use the same "key" to add additional columns
$lstPeople->add('pg', 'Peter');
$lstPeople->add('pg', 'Gibbons');
$lstPeople->add('sn', 'Samir');
$lstPeople->add('sn', 'Nagheenanajar');
$lstPeople->add('mb', 'Michael');
$lstPeople->add('mb', 'Bolton');
$lstPeople->add('mw', 'Milton');
$lstPeople->add('mw', 'Waddams');
$lstPeople->add('bl', 'Bill');
$lstPeople->add('bl', 'Lumbergh');
$lstPeople->add('ts', 'Tom');
$lstPeople->add('ts', 'Smykowski');

$btnSubmit = new Button('choose');
$btnSubmit->submit = true;
$btnSubmit->value = 'Choose!';

?>

<form method="post">
    <?= $lstPeople ?><br>
    <?= $btnSubmit ?>

</form>