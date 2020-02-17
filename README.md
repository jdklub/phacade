_Note: This code was originally written in 2005 as a proof-of-concept and never used in production. Much in the PHP world has changed since then. It is preserved here for entertainment purposes only._

```php
<?php

$txtName = new Textbox('name');
$txtGreeting = new Textbox('greeting');
$btnHello = new Button('hello');
$btnHello->submit = true;
$btnHello->value = 'Hello!';

if($btnHello->clicked)
{
    $name = $txtName->value;
    $txtGreeting->value = 'Hello, $name!';
}
?>

<form>
Greeting: <?= $txtGreeting ?><br>
Enter Your Name: <?= $txtName ?><br>
<?= $btnHello ?>
</form>
```

phacade is a set of components/classes that are designed to make the production of PHP 5 applications quicker, simpler, and more error-free. The goal of phacade is to provide some of the conveniences of full-blown frameworks, such as ASP.NET or JavaServer Faces, without forcing you into a full-blown framework.

phacade aims to provide components that can be used simply for simple projects, and as simply as possible for complex projects. Much like PHP itself, phacade is inteded to work equally well for both procedural and object-oriented scripts. As the name suggests, phacade provides a set of components for the View portion of your application. It doesn't care how you implement the backend — procedural scripts, objects, whatever.

phacade adopts a "PHP-ish" approach wherever possible. There are no XML configuration files, there is no templating language, you don't have to break each page into multiple files (though you can if you want) and you are not forced to re-think the way you use PHP to build web applications. Existing PHP applications can use phacade with minimal modification.