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
            set_session('error', "Mot de passe ou email incorrect");
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

        foreach ($_POST as $key => $value) {
            if (empty($value)) {
                set_session('r_error', "Veuillez remplir tous les champs requis");
                redirect('auth/sign_in');
            }
        }

        $data = $_POST;
        $user = register('users', $data);
        if($user){
            set_session('user', $user);
            redirect('dashboard/home');
        }else{
            set_session('r_error', "Registration failed");
            redirect('auth/sign_in');
        }

    }else{
            set_session('r_error', "Methode invalide");
            redirect('auth/sign_in');
    }
}

