<?php
    
    require_once __DIR__ . '/../functions/Auth.php';
    require_once __DIR__ . '/../helpers/Session.php';

    
    if(empty($_POST)){
        $response = [
            'status' => 'error',
            'message' => 'The user name and password combination you entered does not correspond to a registered user.'
        ];
        echo json_encode($response);
        exit();
    }
    
    $auth = new Auth;
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = $auth->login($username, $password);

    if(!$user){
        $response = [
            'status' => 'error',
            'message' => 'The user name and password combination you entered does not correspond to a registered user.'
        ];
        echo json_encode($response);
        exit();
    }

    Session::start();

    Session::set('userId', $user['id']);
    Session::set('username', $user['username']);
    Session::set('isLoggedIn', true);
    
    
    
    $response = [
        'status' => 'success',
        'message' => 'Successful login'
    ];
    
    echo json_encode($response);

    