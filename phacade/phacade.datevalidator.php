<?php

class DateValidator
{

    function validate($input)
    {
        // we don't use strtotime() because it bumps an invalid date
        // such as 2/29/05 to 3/1/2005 without error

        $timestamp = strtotime($input);
        if ($timestamp == 0) return false;
        $m = date('m', $timestamp);
        $d = date('d', $timestamp);
        $y = date('Y', $timestamp);
        echo "$m / $d / $y";
        if (!checkdate($m, $d, $y)) return false;
        return true;
    }

}

?>