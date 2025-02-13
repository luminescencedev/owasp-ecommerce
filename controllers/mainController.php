<?php

$page = (isset($_GET['page'])) ? $_GET['page'] : 'home';
$user = (isset($_GET['user'])) ? $_GET['user'] : '';


switch ($page) {
    case 'home':
        include '../views/home.php';
        break;
    
    case 'login':
        include '../views/login.php';
        break;
    
    case 'admin':
        include '../views/admin.php';
        break;

    case 'register':
        include '../views/register.php';
        break;
    
    case 'logout':
        session_start();
        session_destroy();
        header('Location: index.php?page=home');
        break;
    
    case 'profile':
        include '../views/profile.php';
        break;
    
    default:
        include '../views/home.php';
        break;
}