<?php

require('model/dashboard.php');

function home_page()
{
	if(isset($_COOKIE['username']) && isset($_COOKIE['password'])  && isset($_COOKIE['table']))
	{
		//setcookie('username', $u_n, time() + 365*24*3600);
		connect_user($_COOKIE['table'], $_COOKIE['username'], $_COOKIE['password']);
		exit();
	}

	$operators = fetch_operators();
	$categories = fetch_categories();
	$top6products = fetch_top6_products(1);
	$recent_products = fetch_products_limit(8);
	
	return [
		'operators'=>$operators,
		'categories'=>$categories,
		'top6products'=>$top6products,
		'recent_products'=>$recent_products,
	];
}

function search_by_category_page(){
	$operators = fetch_operators();
	$categories = fetch_categories();
	$top6products = fetch_top6_products(1);
	$products = fetch_products_by_category($_GET['c_i']);
	
	return [
		'operators'=>$operators,
		'categories'=>$categories,
		'top6products'=>$top6products,
		'products'=>$products
	];
}

function product_page(){
	$operators = fetch_operators();
	$categories = fetch_categories();
	$top6products = fetch_top6_products(1);
	$current_product = fetch_product_details($_GET['p_i']);
	$product_category = fetch_category_by_id($current_product['product_category']);
	$recent_products = fetch_products_limit(20);
	
	return [
		'operators'=>$operators,
		'categories'=>$categories,
		'top6products'=>$top6products,
		'current_product'=>$current_product,
		'product_category'=>$product_category,
		'recent_products'=>$recent_products
	];
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
