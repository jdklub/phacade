<?php
require('../../phacade/phacade.control.php');
require('../../phacade/phacade.textbox.php');
require('../../phacade/phacade.button.php');


// Class to hold all methods and properties for our page.
// This is JSF-esque. This class definition might be stored
// in another file, and simply included.
class MyPage
{

    public $txtName;
    public $txtGreeting;
    public $btnHello;

    function MyPage()
    {
        $this->txtName = new Textbox('name');
        $this->txtGreeting = new Textbox('greeting');
        $this->btnHello = new Button('hello', 'sayHello', $this);
        $this->btnHello->value = 'Hello!';
        $this->btnHello->submit = true;
    }

    public function sayHello()
    {
        $name = $this->txtName->value;
        $this->txtGreeting->value = "Hello, $name!";
    }
}

// create and new instance of the class
$page = new MyPage();
?>

<form>

    Enter Your Name: <?= $page->txtName ?>
    <?= $page->btnHello ?><br>
    Greeting:<?= $page->txtGreeting ?>

</form>