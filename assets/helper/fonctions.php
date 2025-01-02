<?php 

function dd($element){
    echo "<pre>";
    var_dump($element);
    echo "</pre>";
    die();

}

function pd($element){
    echo "<pre>";
    print_r($element);
    echo "</pre>";
    die();

}
function echoo($element){
    echo "<pre>";
    echo $element ;
    echo "</pre>";
    die();

}