<?php
session_start();
unset($_SESSION['name']);
unset($_SESSION['password']);
unset($_SESSION['email']);
header('Location: index.html');
?>