<?php
header("Content-Type: Application/json");

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once "../vendor/autoload.php";
use LiveX\Support\Http\Request;
use Probe\Support\JSON;


Request::capture();



// LiveX::rerender();