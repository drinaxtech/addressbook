<?php
    
    require_once __DIR__ . '/../functions/Crud.php';
    require_once __DIR__ . '/../helpers/Validation.php';
    require_once __DIR__ . '/../core/init.php';

    
    if(empty($_POST)){
        $response = [
            'status' => 'error',
            'message' => 'Please provide the form!'
        ];
        echo json_encode($response);
        exit();
    }
    
    $contacts = new Crud;
    $data = $_POST;

    if(!Validation::updateValidationContact($data)){
        $response = [
            'status' => 'error',
            'message' => 'Please enter valid values!'
        ];
        echo json_encode($response);
        exit();
    }

    $id = $data['id'];
    unset($data['id']);
    $user_id = Session::get('userId');
    
    if($contacts->update($id, $user_id, $data)){
        $response = [
            'status' => 'success',
            'message' => 'The contact is updated successfully!'
        ];
        echo json_encode($response);
        exit();
    }


    $response = [
        'status' => 'error',
        'message' => 'Something went wrong!'
    ];
    echo json_encode($response);
    