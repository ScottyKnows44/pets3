<?php

function validColor($color){
    global $f3;

    return in_array($color,$f3->get('colors'));
}

function validString($text){
    return empty($text);
}