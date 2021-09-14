<?php 

    require_once __DIR__ . '/app/core/init.php';

    Session::destroy();

    Redirect::href('login.php');

