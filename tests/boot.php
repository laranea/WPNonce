<?php

$vendor = dirname(__DIR__).'/vendor/';
if (! realpath($vendor))
{
    die('Please install via Composer before running tests.');
}

require_once $vendor.'autoload.php';
