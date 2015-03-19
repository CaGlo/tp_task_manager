<?php
spl_autoload_register(function ($class) {
//    define('DS',DIRECTORY_SEPARATOR);
    include __DIR__.DIRECTORY_SEPARATOR. $class . '.php';
});