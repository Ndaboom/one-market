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
	$most_viewed = fetch_most_viewed_products(1,8);
	$most_saled = fetch_most_saled_products(1, 8);
	$products = fetch_products_limit(20);
	
	return [
		'operators'=>$operators,
		'categories'=>$categories,
		'top6products'=>$top6products,
		'recent_products'=>$recent_products,
		'most_viewed'=>$most_viewed,
		'most_saled'=>$most_saled,
		'our_products'=>$products
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

function add_product_ajax_page(){
		extract($_POST);
		if(!empty($_POST['product_id']) && !empty($_POST['user_ip']))
		{
				$data = insert_to_cart($_POST['product_id'],$_POST['user_ip']);
				$_SESSION['user_ip'] = $_POST['user_ip'];
				echo $data;
		}else{
			echo "Remplissez touts le champs";
		}
		exit();
}

function remove_product_ajax_page(){
		extract($_POST);
		if(!empty($_POST['order_id']))
		{
				$data = remove_to_cart($_POST['order_id']);
				echo $data;
		}else{
			echo "Données manquants";
		}
		exit();
}

function fetch_cart_ajax_page(){
	extract($_POST);
	if(!empty($_POST['client_ip'])){
		$data = fetch_client_cart($_POST['client_ip']);

		$total_price = 0;
		$total_amount = 0;
		$products = '';
		foreach($data as $row){
		$details = fetch_product_details($row['product_id']);
		
		$total_price = ($details['product_price']*$row['quantity']);
		$total_amount = $total_amount + $total_price;
		
		$products .= '
		<li>
			<div class="img-product">
				<img src="'.$details['product_image'].'" alt="">
			</div>
			<div class="info-product">
				<div class="name">
				'.$details['product_name'].' <br />'.$details['product_category'].'
				</div>
				<div class="price">
					<span>'.$row['quantity'].' x</span>
					<span>$'.$details['product_price'].'</span>
				</div>
			</div>
			<div class="clearfix"></div>
			<span class="remove_from_cart" data-order_id="'.$row['id'].'">x</span>
		</li>
		';
		}

		$output = '<a href="#" title="">
		<div class="icon-cart">
			<img src="assets/landing/images/icons/cart.png" alt="">
			<span>'.count($data).'</span>
		</div>
		<div class="price">
			$'.$total_amount.'
		</div>
		</a>
			<div class="dropdown-box">
				<ul>
					'.$products.'
				</ul>
				<div class="total">
					<span>Subtotal:</span>
					<span class="price">$'.$total_amount.'</span>
				</div>
				<div class="btn-cart">
					<a href="#" class="view-cart" title="">View Cart</a>
					<a href="#" class="check-out" title="">Checkout</a>
				</div>
			</div>';

		echo $output;
		
	}
	exit();
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
