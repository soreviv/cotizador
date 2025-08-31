<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo "<h1>DEBUGGING SESSION</h1>";
    echo "<p>Session 'loggedin' is not set or not true.</p>";
    echo "<pre>";
    var_dump($_SESSION);
    echo "</pre>";
    exit;
}
require_once('tcpdf/tcpdf.php');