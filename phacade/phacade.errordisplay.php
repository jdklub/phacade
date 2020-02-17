<?php

class ErrorDisplay
{
    var $errors = array();
    var $cssclass;


    function ErrorDisplay()
    {

    }

    function add($msg)
    {
        $this->errors[] = $msg;
    }

    function size()
    {
        return sizeof($this->errors);
    }

    function render()
    {
        $e = '<div class="' . $this->cssclass . '">';
        $e .= '<ul>';
        reset($this->errors);
        while (list($idx, $msg) = each($this->errors)) {
            $e .= "<li>$msg</li>";
        }

        $e .= '</ul>';
        $e .= '</div>';

        return $e;

    }

    function display()
    {
        echo $this->render();
    }

}

?>