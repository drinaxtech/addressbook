<?php
    
    require_once __DIR__ . '/../functions/Auth.php';
    require_once __DIR__ . '/../helpers/Validation.php';

    
    if(empty($_POST)){
        $response = [
            'status' => 'error',
            'message' => 'Please provide the form!'
        ];
        echo json_encode($response);
        exit();
    }
    
    $user = new Auth;
    $data = $_POST;

    if(!Validation::insertValidationUser($data)){
        $response = [
            'status' => 'error',
            'message' => 'Please enter valid values!'
        ];
        echo json_encode($response);
        exit();
    }

    if($user->checkIfExists('email', $data['email'])){
        $response = [
            'status' => 'error',
            'message' => 'User with this email is already register!'
        ];
        echo json_encode($response);
        exit();
    }

    if($user->checkIfExists('username', $data['username'])){
        $response = [
            'status' => 'error',
            'message' => 'User with this username is already register!'
        ];
        echo json_encode($response);
        exit();
    }

    unset($data['confirm_password']);
    
    if($user->create($data)){
        $response = [
            'status' => 'success',
            'message' => 'Register successfully!'
        ];
        echo json_encode($response);
        exit();
    }



    $response = [
        'status' => 'error',
        'message' => 'Something went wrong!'
    ];
    echo json_encode($response);
    