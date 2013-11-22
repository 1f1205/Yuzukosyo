<?php

function __autoload($class_name) {
    require_once $class_name . '.php';
}

$crawler = new Crawler();
$crawler->exec();
