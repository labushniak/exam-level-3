<?php

class Flash
{
    public static function set($status = null, $message = null)
    {
        if($status && $message){
            $_SESSION[$status] = $message;
            return true;
        } else {
            return false;
        }
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