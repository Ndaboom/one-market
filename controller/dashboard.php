<?php
require('model/dashboard.php');

function home_page()
{
	$shops = fetch_shops();
    $users = fetch_users();
    $user = find("users",$_SESSION['user']['id']);
    $products = fetch_all_products();
    $operators = fetch_operators();
    $categories = fetch_categories();
    $todays_products = fetch_todays_product();
   
    return [
        'users' => $users,
        'shops' => $shops,
        'user' => $user,
        'products' => $products,
        'operators' => $operators,
        'categories' => $categories,
        'todays_products' => $todays_products,
    ];
}

function create_operator_page(){
    
    $countries = fetch_countries();
    $states = fetch_states();
    $cities = fetch_cities();
    $user = find("users",$_SESSION['user']['id']);

    if(isset($_GET['op_i'])){
        $operator = fetch_operator_details($_GET['op_i']);
        return [
            'countries' => $countries,
            'user' => $user,
            'operator' => $operator,
            'states' => $states,
            'cities' => $cities
        ];
    }else{
        return [
            'countries' => $countries,
            'user' => $user,
            'states' => $states,
            'cities' => $cities
        ];
    }

}

function fetch_country_states_page(){

    $data = fetch_country_states($_POST['country_id']);

    $output ='<option data-display="Select">Choisissez une province</option>';
	foreach ($data as $row) {
		$output .='<option value='.$row['id'].' id='.$row['id'].'>
		'.$row['name'].'</option>';
	}

    echo $output;

    exit();
}

function fetch_state_cities_page(){
    $data = fetch_state_cities($_POST['state_id']);

    $output ='<option data-display="Select">Choisissez une ville</option>';
	foreach ($data as $row) {
		$output .='<option value='.$row['id'].' id='.$row['id'].'>
		'.$row['name'].'</option>';
	}

    echo $output;

    exit();

}

function add_operator_page(){

    if (is_method('POST')) {

        $data = $_POST;

        $path = '/assets/images/operators';
		$photo = save_file($_FILES['file'], $path);
		
		if (is_string($photo)) {

			$data['operator_logo'] = ltrim($path, '/') . '/' . $photo;
	
	        insert_operator($data);

            redirect('dashboard/operators_list');

        }
    }

}

function edit_operator_page(){

    if (is_method('POST')) {

        $data = $_POST;

        $path = '/assets/images/operators';
        if($_FILES['file']){
            $photo = save_file($_FILES['file'], $path);
            //image update
            if (is_string($photo)) {

                $data['operator_logo'] = ltrim($path, '/') . '/' . $photo;
                update_operator_logo($data, $_GET['op_i']);

            }
        }
		    
	        update_operator($data, $_GET['op_i']);

            redirect('dashboard/operators_list');

    }

}

function edit_user_page(){

    if (is_method('POST')) {

        $data = $_POST;	

        if(!empty($data['password'])){
            update_user_password($data, $_GET['u_i']);
        }

        update_user($data, $_GET['u_i']);

        redirect('dashboard/users_list');

    }

}

function change_operator_status_page(){
    if(isset($_GET['op_i']) || isset($_GET['status'])) {
        update_operator_status($_GET['op_i'],$_GET['status']);
    }
    redirect('dashboard/operators_list');
}

function create_user_page(){
    $shops = fetch_shops();
    $countries = fetch_countries();
    $user = find("users",$_SESSION['user']['id']);
    $states = fetch_states();
    $cities = fetch_cities();
    $product_categories = fetch_categories();

    if(isset($_GET['u_i'])){
    $current_user = find("users",$_GET['u_i']);
        return [
            'countries' => $countries,
            'shops' => $shops,
            'user' => $user,
            'current_user' => $current_user,
            'states' => $states,
            'cities' => $cities,
            'product_categories'=> $product_categories
        ];
    }else{
        return [
            'countries' => $countries,
            'shops' => $shops,
            'user' => $user,
            'states' => $states,
            'cities' => $cities,
            'product_categories'=> $product_categories
        ];
    } 
}

function add_user_page(){
    if (is_method('POST')) {

        $data = $_POST;	
        insert_user($data);

        redirect('dashboard/home');

    }
}

function operators_list_page(){
    $shops = fetch_shops();
    $countries = fetch_countries();
    $operators = fetch_operators();
    $shops = fetch_shops();
    $users = fetch_users();
    $user = find("users",$_SESSION['user']['id']);
    $products = fetch_products($user['shop_id']);
    $categories = fetch_categories();
    
    return [
		'countries' => $countries,
        'shops' => $shops,
        'operators' => $operators,
        'users' => $users,
        'shops' => $shops,
        'user' => $user,
        'products' => $products,
        'categories' => $categories,
	];    
}

function users_list_page(){
    $shops = fetch_shops();
    $countries = fetch_countries();
    $operators = fetch_operators();
    $shops = fetch_shops();
    $users = fetch_users();
    $user = find("users",$_SESSION['user']['id']);
    $products = fetch_products($user['shop_id']);
    $categories = fetch_categories();
    
    return [
		'countries' => $countries,
        'shops' => $shops,
        'operators' => $operators,
        'users' => $users,
        'shops' => $shops,
        'user' => $user,
        'products' => $products,
        'categories' => $categories,
	];
}

function logout_page(){
    session_start(); 
    session_destroy();
    $_SESSION=[];

    redirect('auth/sign_in');
}

function create_product_page(){
    $shops = fetch_shops();
    $users = fetch_users();
    $user = find("users",$_SESSION['user']['id']);
    $categories = fetch_categories();
   
    return [
        'users' => $users,
        'shops' => $shops,
        'user' => $user,
        'product_categories'=> $categories
    ];
}

function add_product_page(){
    $user = find("users", $_SESSION['user']['id']);
    
    if (is_method('POST')) {

        $data = $_POST;

        $path = '/assets/images/products';
		$photo = save_file($_FILES['image'], $path);
		
		if (is_string($photo)) {

			$data['product_image'] = ltrim($path, '/') . '/' . $photo;
	
	        insert_product($data, $user['shop_id']);

            redirect('dashboard/products_list');

        }
    }
}

function aproducts_list_page(){
    $shops = fetch_shops();
    $users = fetch_users();
    $user = find("users",$_SESSION['user']['id']);
    $products = fetch_all_products();
    $operators = fetch_operators();
    $categories = fetch_categories();

    if(isset($_GET['tri'])){
        if($_GET['tri'] == "low_price"){
            $products = fetch_products_low_price($user['shop_id']);
        }else if($_GET['tri'] == "high_price"){
            $products = fetch_products_high_price($user['shop_id']);
        }
    }
   
    return [
        'users' => $users,
        'shops' => $shops,
        'user' => $user,
        'products' => $products,
        'operators' => $operators,
        'categories' => $categories
    ];
}

function products_list_page(){
    $shops = fetch_shops();
    $users = fetch_users();
    $user = find("users",$_SESSION['user']['id']);
    $products = fetch_products($user['shop_id']);

    if(isset($_GET['tri'])){
        if($_GET['tri'] == "low_price"){
            $products = fetch_products_low_price($user['shop_id']);
        }else if($_GET['tri'] == "high_price"){
            $products = fetch_products_high_price($user['shop_id']);
        }
    }
   
    return [
        'users' => $users,
        'shops' => $shops,
        'user' => $user,
        'products' => $products,
    ];
}

function products_categories_page(){
    $shops = fetch_shops();
    $users = fetch_users();
    $user = find("users",$_SESSION['user']['id']);
    $products = fetch_products($user['shop_id']);
    $categories = fetch_categories();

    return [
        'users' => $users,
        'shops' => $shops,
        'user' => $user,
        'products' => $products,
        'categories' => $categories,
    ];
}

function product_page(){
    $shops = fetch_shops();
    $users = fetch_users();
    $user = find("users",$_SESSION['user']['id']);
    $products = fetch_products($user['shop_id']);
    $product = fetch_product_details($_GET['pr_i']);
    $operators = fetch_operators();
    $categories = fetch_categories();

   
    return [
        'users' => $users,
        'shops' => $shops,
        'user' => $user,
        'products' => $products,
        'product' => $product,
        'operators' => $operators,
        'categories' => $categories
    ];
}

function edit_product_page(){
    $shops = fetch_shops();
    $users = fetch_users();
    $user = find("users",$_SESSION['user']['id']);
    $products = fetch_products($user['shop_id']);
    $product = fetch_product_details($_GET['pr_i']);
    $categories = fetch_categories();

   
    return [
        'users' => $users,
        'shops' => $shops,
        'user' => $user,
        'products' => $products,
        'product' => $product,
        'categories' => $categories
    ];
}

function edit_product_validation_page(){
    $user = find("users", $_SESSION['user']['id']);
    
    if (is_method('POST')) {

        $data = $_POST;

        if($_FILES){
            $path = '/assets/images/products';
            $photo = save_file($_FILES['image'], $path);
            if (is_string($photo)) {
    
                $data['product_image'] = ltrim($path, '/') . '/' . $photo;
                update_product_image($_GET['pr_i'],$data['product_image']);
            }
        }

        update_product($_GET['pr_i'],$data);

        redirect('dashboard/products_list');
    }

    redirect('dashboard/edit_product?pr_i='.$_GET['pr_i']);
}

function create_category_page(){
    $shops = fetch_shops();
    $users = fetch_users();
    $user = find("users",$_SESSION['user']['id']);
    $products = fetch_products($user['shop_id']);
    $categories = fetch_categories();

   
    return [
        'users' => $users,
        'shops' => $shops,
        'user' => $user,
        'products' => $products,
        'categories' => $categories
    ]; 
}

function add_category_validation_page(){
    $user = find("users", $_SESSION['user']['id']);

    if (is_method('POST')) {

        $data = $_POST;

        if($_POST['status'] == "on"){
            $data['status'] = "1";
        }else{
            $data['status'] = "0";
        }

        add_category($data, $user['shop_id']);

        redirect('dashboard/products_categories');
    }

    redirect('dashboard/create_category');
}

function user_config_page(){
    $shops = fetch_shops();
    $users = fetch_users();
    $user = find("users",$_SESSION['user']['id']);
    $products = fetch_products($user['shop_id']);
    $categories = fetch_categories();

   
    return [
        'users' => $users,
        'shops' => $shops,
        'user' => $user,
        'products' => $products,
        'categories' => $categories
    ]; 
}


