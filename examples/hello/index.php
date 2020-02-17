<?php
require('../../phacade/phacade.control.php');
require('../../phacade/phacade.textbox.php');
require('../../phacade/phacade.button.php');


$txtName = new Textbox('name');

$txtGreeting = new Textbox('greeting');

$btnHello = new Button('hello');
$btnHello->submit = true;
$btnHello->value = 'Hello!';

if ($btnHello->clicked) {
    $txtGreeting->value = 'Hello, ' . $txtName->value . '!';
}

?>

<form>
    Enter Your Name: <?= $txtName ?><?= $btnHello ?><br>
    Greeting: <?= $txtGreeting ?>
</form>