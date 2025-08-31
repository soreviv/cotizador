<?php
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