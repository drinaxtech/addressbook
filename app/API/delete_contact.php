<?php
    
    require_once __DIR__  . '/../functions/Crud.php';
    require_once __DIR__ . '/../core/init.php';
    
    if(empty($_POST['id'])){
        $response = [
            'status' => 'error',
            'message' => 'Wrong request!'
        ];
        echo json_encode($response);
        exit();
    }
    
    $contacts = new Crud;
    $id = $_POST['id'];
    $user_id = Session::get('userId');
    
    if($contacts->delete($id, $user_id)){
        $response = [
            'status' => 'success',
            'message' => 'The contact is deleted successfully!'
        ];
        echo json_encode($response);
        exit();
    }


    $response = [
        'status' => 'error',
        'message' => 'Something went wrong!'
    ];
    echo json_encode($response);
    