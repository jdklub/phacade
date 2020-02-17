<?php

class EvenValidator
{
    function validate($input)
    {
        return !($input % 2);
    }
}


?>