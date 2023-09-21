<?php

spl_autoload_register(function ($class) {
    $class = 'classes/' . str_replace('\\', '/', $class) . '.php';
    include $class;
});
