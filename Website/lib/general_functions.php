<?php

    function toDisplayDate($date)
    {
        if ($phpDate = strtotime($date))
        return date('m/d/Y', $phpDate);
       else
        return "";
     }
     function toMySQLDate($date)
     {
        if ($phpDate = strtotime($date))
        return date('Y-m-d', $phpDate);
       else
        return "";
     }
     function unQuote() {
        if (get_magic_quotes_gpc()) {
            function stripslashes_gpc(&$value) {
               $value = stripslashes($value);
            }
            array_walk_recursive($_GET, 'stripslashes_gpc');
            array_walk_recursive($_POST, 'stripslashes_gpc');
            array_walk_recursive($_COOKIE, 'stripslashes_gpc');
            array_walk_recursive($_REQUEST, 'stripslashes_gpc');
        }
     }
?>