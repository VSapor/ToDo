<?php
session_destroy();
$_SESSION = [];
session_unset();
require_once 'main.php';
echo view('home');