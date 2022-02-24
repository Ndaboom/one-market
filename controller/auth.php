<?php
require('model/auth.php');

function sign_in_page()
{
	return [
        'message' => 'Bonjour les amis'
    ];
}

function sign_in_validation_page()
{
    if (is_method('POST')) {
        var_dump($_POST);
        $user = login('users', $_POST['email'], $_POST['password']);
        if($user){
            set_session('user', $user);
            redirect('dashboard/home');
        }else{
            echo "Not found";
            exit();
            redirect('auth/sign_in');
        }

    }

	return [
        'message' => 'Inscription echoué'
    ];
}

function sign_up_validation_page(){
    if (is_method('POST')) {
        var_dump($_POST);
        $user = register('users', $_POST['fullname'], $_POST['telephone'], $_POST['birth_date'], $_POST['emailadress'], $_POST['password']);

        if($user){
            set_session('user', $user);
            redirect('dashboard/home');
        }else{
            echo "Not found";
            exit();
            redirect('auth/sign_in');
        }


    }
}

