<?php
  
    require_once __DIR__ . '/../helpers/Session.php';
    require_once __DIR__ . '/../helpers/Redirect.php';

    Session::start();

    $current_url = $_SERVER['REQUEST_URI'];
    $urlArr = explode('/', $current_url); 
    $endUrl = end($urlArr);
    //exit();


    if(Session::exists('isLoggedIn') && ($endUrl === 'login.php' || $endUrl === 'register.php')) {
        Redirect::href('index.php');
    } else if(!Session::exists('isLoggedIn') && $endUrl !== 'login.php' && $endUrl !== 'register.php'){
        Redirect::href('login.php');
    }
    

