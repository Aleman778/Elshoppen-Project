<?php
    //This php file is used to check the access permissions to use the admin pages.
    //This script should be included in all the admin pages to avoid hackers.
    $root = $_SERVER['DOCUMENT_ROOT'];
    $url = explode('?', $_SERVER['REQUEST_URI'], 2)[0];

    $string = file_get_contents("$root/admin/access.json");
    define("ACCESS", json_decode($string, true));
    
    if (!isset($url)) {
        header("Location: /");
    }

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!array_key_exists("role", $_SESSION)) {
        header("Location: /");
        exit;
    }

    
    $role = $_SESSION["role"];

    if (!array_key_exists($role, ACCESS)) {   
        header("Location: /");
        exit;
    }
    if (!in_array("ALL", ACCESS[$role])) {
        if (!in_array($url, ACCESS[$role])) {
            header("Location: /admin/?err=permission");
            exit;
        }
    }

    function checkAccess($url) {
        $role = $_SESSION["role"];
        
        if (!array_key_exists($role, ACCESS))
            return false;
        if (in_array("ALL", ACCESS[$role]))
            return true;
        if (!in_array($url, ACCESS[$role]))
            return false;

        return true;
    }
?>