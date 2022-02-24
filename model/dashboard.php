<?php

function  fetch_countries(){
    global $db;
	$query = "SELECT * FROM countries WHERE status= :active";
	$result = $db->prepare($query);
	$result->execute(['active'=>"active"]);
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

function  fetch_states(){
    global $db;
	$query = "SELECT * FROM states WHERE status= :active";
	$result = $db->prepare($query);
	$result->execute(['active'=>"active"]);
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

function  fetch_cities(){
    global $db;
	$query = "SELECT * FROM cities WHERE status= :active";
	$result = $db->prepare($query);
	$result->execute(['active'=>"active"]);
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

function  fetch_shops(){
    global $db;
	$query = "SELECT * FROM operators_tb WHERE operator_status= :active";
	$result = $db->prepare($query);
	$result->execute(['active'=>"active"]);
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

function fetch_country_states($country_id){
    global $db;
	$query = "SELECT * FROM states WHERE country_id= :country_id";
	$result = $db->prepare($query);
	$result->execute(['country_id'=>$country_id]);
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;    
}

function fetch_state_cities($state_id){
    global $db;
	$query = "SELECT * FROM cities WHERE state_id= :state_id";
	$result = $db->prepare($query);
	$result->execute(['state_id'=>$state_id]);
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;    
}

function insert_operator(array $d){
	global $db;
	$status = 'active';
	
	$sql = 'INSERT INTO operators_tb (operator_name, operator_description, operator_category, operator_country, operator_state, operator_city, operator_adress, operator_status, operator_logo) 
			VALUES(:operator_name, :operator_description, :operator_category, :operator_country, :operator_state, :operator_city, :operator_adress, :operator_status, :operator_logo)';
	
	$i = $db->prepare($sql);
	
	$i->bindValue(':operator_name', $d['operator_name']);
	$i->bindValue(':operator_description', $d['operator_description']);
	$i->bindValue(':operator_category', $d['operator_category']);
	$i->bindValue(':operator_country', $d['operator_country']);
	$i->bindValue(':operator_state', $d['operator_state']);
	$i->bindValue(':operator_city', $d['operator_city']);
	$i->bindValue(':operator_adress', $d['operator_adress']);
	$i->bindValue(':operator_status', $status);
	$i->bindValue(':operator_logo', $d['operator_logo']);
	$i->execute();
}

function update_operator(array $d, $id){
	global $db;
	$status = 'active';
	
	$sql = 'UPDATE operators_tb SET operator_name= :operator_name,operator_description= :operator_description, operator_category= :operator_category, operator_country= :operator_country, operator_state= :operator_state, operator_city= :operator_city, operator_adress= :operator_adress, operator_status= :operator_status 
			WHERE id= :id';
	
	$i = $db->prepare($sql);
	
	$i->bindValue(':operator_name', $d['operator_name']);
	$i->bindValue(':operator_description', $d['operator_description']);
	$i->bindValue(':operator_category', $d['operator_category']);
	$i->bindValue(':operator_country', $d['operator_country']);
	$i->bindValue(':operator_state', $d['operator_state']);
	$i->bindValue(':operator_city', $d['operator_city']);
	$i->bindValue(':operator_adress', $d['operator_adress']);
	$i->bindValue(':operator_status', $status);
	$i->bindValue(':id', $id);
	$i->execute();
}

function update_operator_logo(array $d, $id){
	global $db;
	
	$sql = 'UPDATE operators_tb SET operator_logo= :operator_logo 
			WHERE id= :id';
	
	$i = $db->prepare($sql);
	
	$i->bindValue(':operator_logo', $d['operator_logo']);
	$i->bindValue(':id', $id);
	$i->execute();
}

function update_operator_status($operator_id, $status){
	global $db;
	
	$sql = 'UPDATE operators_tb SET operator_status= :operator_status 
			WHERE id= :id';
	
	$i = $db->prepare($sql);
	
	$i->bindValue(':operator_status', $status);
	$i->bindValue(':id', $operator_id);
	$i->execute();
}

function  insert_user(array $d){
	global $db;
	
	$sql = 'INSERT INTO users (username, password, first_name, last_name, phone_number, email, country, state, city, adress, shop_id) 
			VALUES(:username, :password, :first_name, :last_name, :phone_number, :email, :country, :state, :city, :adress, :shop_id)';
	
	$i = $db->prepare($sql);
	
	$i->bindValue(':username', $d['email']);
	$i->bindValue(':email', $d['email']);
	$i->bindValue(':first_name', $d['first_name']);
	$i->bindValue(':last_name', $d['last_name']);
	$i->bindValue(':phone_number', $d['phone_number']);
	$i->bindValue(':password', sha1($_POST['password']));
	$i->bindValue(':country', $d['country']);
	$i->bindValue(':state', $d['state']);
	$i->bindValue(':city', $d['city']);
	$i->bindValue(':adress', $d['adress']);
	$i->bindValue(':shop_id', $d['shop_id']);
	$i->execute();
}

function  update_user(array $d, $user_id){
	global $db;
	
	$sql = 'UPDATE users SET username= :username, password= :password, first_name= :first_name, last_name= :last_name, phone_number= :phone_number, email= :email, country= :country, state= :state, city= :city, adress= :adress, shop_id= :shop_id
			WHERE id= :id';
	
	$i = $db->prepare($sql);
	
	$i->bindValue(':username', $d['email']);
	$i->bindValue(':email', $d['email']);
	$i->bindValue(':first_name', $d['first_name']);
	$i->bindValue(':last_name', $d['last_name']);
	$i->bindValue(':phone_number', $d['phone_number']);
	$i->bindValue(':password', sha1($d['password']));
	$i->bindValue(':country', $d['country']);
	$i->bindValue(':state', $d['state']);
	$i->bindValue(':city', $d['city']);
	$i->bindValue(':adress', $d['adress']);
	$i->bindValue(':shop_id', $d['shop_id']);
	$i->bindValue(':id', $user_id);
	$i->execute();
}

function  update_user_password(array $d, $user_id){
	global $db;
	
	$sql = 'UPDATE users SET password= :password
			WHERE id= :id';
	
	$i = $db->prepare($sql);
	
	$i->bindValue(':password', sha1($d['password']));
	$i->bindValue(':id', $user_id);
	$i->execute();
}

function fetch_operators(){
	global $db;
	$query = "SELECT * FROM operators_tb";
	$result = $db->prepare($query);
	$result->execute();
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;  
}

function fetch_users(){
	global $db;
	$query = "SELECT * FROM users WHERE super_user!= :super_user";
	$result = $db->prepare($query);
	$result->execute(['super_user'=>1]);
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

function insert_product(array $d,$shop_id){
	global $db;
	
	$sql = 'INSERT INTO products_tb (product_name, product_description, product_category, product_price, product_image,product_quantity,shop_id,created_at) 
			VALUES(:product_name, :product_description, :product_category, :product_price, :product_image,:product_quantity, :shop_id, NOW())';
	
	$i = $db->prepare($sql);
	
	$i->bindValue(':product_name', $d['product_name']);
	$i->bindValue(':product_description', $d['product_description']);
	$i->bindValue(':product_category', $d['product_category']);
	$i->bindValue(':product_price', $d['product_price']);
	$i->bindValue(':product_image', $d['product_image']);
	$i->bindValue(':product_quantity', $d['product_quantity']);
	$i->bindValue(':shop_id', $shop_id);
	$i->execute();	
}

function fetch_all_products(){
	global $db;
	$query = "SELECT * FROM products_tb";
	$result = $db->prepare($query);
	$result->execute();
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

function fetch_products($shop_id){
	global $db;
	$query = "SELECT * FROM products_tb WHERE shop_id= :shop_id";
	$result = $db->prepare($query);
	$result->execute(['shop_id' => $shop_id]);
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

function fetch_products_low_price($shop_id){
	global $db;
	$query = "SELECT * FROM products_tb 
			  WHERE shop_id= :shop_id
			  ORDER BY product_price ASC";
	$result = $db->prepare($query);
	$result->execute(['shop_id' => $shop_id]);
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

function fetch_products_high_price($shop_id){
	global $db;
	$query = "SELECT * FROM products_tb 
			  WHERE shop_id= :shop_id
			  ORDER BY product_price DESC";
	$result = $db->prepare($query);
	$result->execute(['shop_id' => $shop_id]);
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

function fetch_categories(){
	global $db;
	$query = "SELECT * FROM product_categories";
	$result = $db->prepare($query);
	$result->execute();
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

function fetch_todays_product(){
	global $db;
	$query = "SELECT * FROM products_tb
			  WHERE DATE(`created_at`) = CURDATE()";
	$result = $db->prepare($query);
	$result->execute();
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

function fetch_product_details($product_id){
	global $db;
	$query = "SELECT * FROM products_tb WHERE id= :product_id";
	$result = $db->prepare($query);
	$result->execute(['product_id' => $product_id]);
	$data = $result->fetch(PDO::FETCH_ASSOC);
	return $data;
}

function update_product($product_id,array $d){
	global $db;
	
	$sql = 'UPDATE products_tb SET product_name= :product_name, product_description= :product_description, product_category= :product_category, product_price= :product_price, product_quantity= :product_quantity
			WHERE id= :id';
	
	$i = $db->prepare($sql);
	
	$i->bindValue(':product_name', $d['product_name']);
	$i->bindValue(':product_description', $d['product_description']);
	$i->bindValue(':product_category', $d['product_category']);
	$i->bindValue(':product_price', $d['product_price']);
	$i->bindValue(':product_quantity', $d['product_quantity']);
	$i->bindValue(':id', $product_id);
	$i->execute();
}

function  update_product_image($product_id,$image_path){
	global $db;
	
	$sql = 'UPDATE products_tb SET product_image= :product_image
			WHERE id= :id';
	
	$i = $db->prepare($sql);
	
	$i->bindValue(':product_image', $image_path);
	$i->bindValue(':id', $product_id);
	$i->execute();
	
}

function add_category(array $d, $shop_id){
	global $db;
	
	$sql = 'INSERT INTO product_categories (designation, shop_id, status) 
			VALUES(:designation, :shop_id, :status)';
	
	$i = $db->prepare($sql);
	
	$i->bindValue(':designation', $d['designation']);
	$i->bindValue(':shop_id', $shop_id);
	$i->bindValue(':status', $d['status']);
	$i->execute();
}

function fetch_operator_details($operator_id){
	global $db;
	$query = "SELECT * FROM operators_tb WHERE id= :id";
	$result = $db->prepare($query);
	$result->execute(['id' => $operator_id]);
	$data = $result->fetch(PDO::FETCH_ASSOC);
	return $data;
}

function fetch_operator_categories($shop_id){
	global $db;
	$query = "SELECT * FROM product_categories WHERE shop_id= :id";
	$result = $db->prepare($query);
	$result->execute(['id' => $shop_id]);
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

//Fetch top6 viewed product
function fetch_top6_products($status){
	global $db;
	$query = "SELECT * FROM products_tb WHERE product_status= :status 
			  ORDER BY product_views DESC LIMIT 6";
	$result = $db->prepare($query);
	$result->execute(['status' => $status]);
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

//Fetch products by category
function fetch_products_by_category($category_id){
	global $db;
	$query = "SELECT * FROM products_tb WHERE product_category= :id";
	$result = $db->prepare($query);
	$result->execute(['id' => $category_id]);
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

//fetch category info by id
function fetch_category_by_id($category_id){
	global $db;
	$query = "SELECT * FROM product_categories WHERE id= :id";
	$result = $db->prepare($query);
	$result->execute(['id' => $category_id]);
	$data = $result->fetch(PDO::FETCH_ASSOC);
	return $data;
}

//Fecth product with a limit 
function fetch_products_limit($limit){
	global $db;
	$query = "SELECT * FROM products_tb ORDER BY created_at DESC LIMIT ".$limit."";
	$result = $db->prepare($query);
	$result->execute();
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}