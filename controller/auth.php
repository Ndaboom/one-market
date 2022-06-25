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
    $error = '';
    if (is_method('POST')) {
        var_dump($_POST);
        $user = login('users', $_POST['email'], $_POST['password']);
        if($user){
            set_session('user', $user);
            redirect('dashboard/home');
        }else{
            $error = "Mot de passe/username incorrect";
            redirect('auth/sign_in');
        }

    }

	return [
        'message' => $error,
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
            echo "Registration failed";
            redirect('auth/sign_in');
        }
    }
}

