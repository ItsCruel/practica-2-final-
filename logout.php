<?php
session_start();
require_once __DIR__ . "/inc/Login.php";
$login = new Login();
$login->cerrarSesion();
