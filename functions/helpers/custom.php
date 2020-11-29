<?php

/**
 * Include all php inside the path dir
 */
if (!function_exists('includeFiles')) {
    function includeFiles($pathdir)
    {
        foreach (glob("{$pathdir}/*.php") as $filename) {
            include_once($filename);
        }
    }
}

/**
 * General checker
 */
if (!function_exists('checker')) {
    function checker($var)
    {
        if ($var && $var != '' && !empty($var) && !is_null($var)) {
            return true;
        } else {
            return false;
        }
    }
}

/** Get datetime */
if (!function_exists('getDateTime')) {
    function getDateTime($datetime)
    {
        return new DateTime($datetime);
    }
}
