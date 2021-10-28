<?php

// require 'model/posts.php';
//require 'model/owners.php';

function home_page()
{
	if(isset($_COOKIE['username']) && isset($_COOKIE['password'])  && isset($_COOKIE['table']))
	{
		//setcookie('username', $u_n, time() + 365*24*3600);
		connect_user($_COOKIE['table'], $_COOKIE['username'], $_COOKIE['password']);
		exit();
	}


	if (session_exists('role')) {
		redirect(get_session('role') . '/home');
		exit();
	}
	
	$ret = [];
	
	if (is_method('POST')) {
		$u_n = $_POST['username'];
		$pass = sha1($_POST['password']);
		
		if ( ! ($user = login('Owners', $u_n, $pass))) {
			$user = login('Users', $u_n, $pass);
		}
		
		if ( ! $user) {
			$ret['errors'] = true;
		} else {
			setcookie('username', $u_n, time() + 365*24*3600);
			setcookie('password', $pass, time() + 365*24*3600);
			$table = $user['role'];
			setcookie('table', $table, time() + 365*24*3600);
			if (array_key_exists('role', $user)) 
			{
				if ( ! (bool) $user['role']) {
					$ret['errors'] = true;
				} else {
					// User is not an owner
					set_session('user', $user);
					set_session('role', $user['role']);
					//Just to know where the user works
					$entity_id = $user['entity_id'];
					$_SESSION['user_entity_info'] = get_user_entity_info($table, $entity_id);
					redirect($user['role'] . '/home');
				}
			} else {
				set_session('owner', $user);
				set_session('firm', find_firm_by_owner($user['id']));
				set_session('role', 'owner');
				redirect('owners/home');
			}
		}
	}
	
	return $ret;
}

function connect_user($table, $username, $password)
{
	
	$ret = [];
	
	$u_n = $username;
	$pass = $password;
	
	if ( ! ($user = login('owners', $u_n, $pass))) {
		$user = login('users', $u_n, $pass);
	}
	
	if ( ! $user) {
		$ret['errors'] = true;
	} else {
		if (array_key_exists('role', $user)) {
			if ( ! (bool) $user['role']) {
				$ret['errors'] = true;
			} else {
				// User is not an owner
				set_session('user', $user);
				set_session('role', $user['role']);
				//Just to know where the user works
				$table = $user['role'];
				$entity_id = $user['entity_id'];
				$_SESSION['user_entity_info'] = get_user_entity_info($table, $entity_id);
				redirect($user['role'] . '/home');
			}
		} else {
			set_session('owner', $user);
			set_session('firm', find_firm_by_owner($user['id']));
			set_session('role', 'owner');
			redirect('owners/home');
		}
	}

}
{

}
function sign_up_page()
{
	
	redirect('owner/home');
}

function logout_page()
{
	// remove_session('firm');
	// remove_session('owner');
	// remove_session('user');
	// remove_session('role');
	session_destroy();
	setcookie('username',null);
	setcookie('password',null);
	setcookie('table',null);
	redirect('home');
	exit();
}


// function add_category_page()
// {
	// if (is_method('POST')) {
		// $errors = validate_errors([
			// 'designation' => validate_str($_POST['designation']),
			// 'critical_period' => validate_date($_POST['critical_period']),
		// ]);
		
		// if ( ! $errors) {
			// insert_category($_POST);
			// create_msg('Catégorie inserée'); 
			// redirect('?page=add_category');
		// }
	// }
// }

// function add_item_page()
// {
	// $categories = get_all_categories();
	
	// if ( ! $categories) {
		// redirect('?page=add_category');
	// }
	
	// if (is_method('POST')) {
		// $errors = validate_errors([
			// 'designation' => validate_str($_POST['designation']),
			// 'critical_period' => validate_date($_POST['critical_period']),
		// ]);
		
		// if ( ! $errors) {
			// insert_article($_POST);
			// create_msg('Article inseré'); 
			// redirect('?page=add_item');
		// }
	// }
	
	// return [
		// 'categories' => $categories,
	// ];
// }

