<?php

class Flash
{
    public static function set($status, $message)
    {
        return $_SESSION[$status] = $message;
    }

    public static function message($status = NULL)
    {
        $message = "";
        
        if ($_SESSION[$status]){
            $message = "<div class=\"alert alert-{$status}\" role=\"alert\">" .$_SESSION[$status] . "</div>";
            $_SESSION[$status] = NULL;
            
        }

        return $message;
    }
}