<?php
function __autoload($className){
    $path = 'classes/';

    if(!empty($className) && file_exists($path.$className.'.php')){
        require_once($path.$className.'.php');
    }
}