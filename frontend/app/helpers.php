<?php

if (!function_exists('intValue')) {
    function intValue($string) {
        $asciiValue = ord($string);
        $integerValue = intval($asciiValue);

        return $integerValue;
    }
}

?>
