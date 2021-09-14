<?php
    
    require_once __DIR__ . '/../functions/Crud.php';
    require_once __DIR__ . '/../core/init.php';

    $contacts = new Crud;
    $user_id = Session::get('userId');
    

    $results = $contacts->read($user_id);

    echo json_encode($results);
    