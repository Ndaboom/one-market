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
	
	$sql = 'INSERT INTO products_tb (product_name, product_description, product_category,product_sous_category, product_price, product_image,product_quantity,product_model,product_make,product_color,shop_id,created_at) 
			VALUES(:product_name, :product_description, :product_category, :product_sous_category,:product_price, :product_image,:product_quantity,:product_model,:product_make,:product_color,:shop_id, NOW())';
	
	$i = $db->prepare($sql);
	
	$i->bindValue(':product_name', $d['product_name']);
	$i->bindValue(':product_description', $d['product_description']);
	$i->bindValue(':product_category', $d['product_category']);
	$i->bindValue(':product_sous_category', $d['product_sous_category']);
	$i->bindValue(':product_price', $d['product_price']);
	$i->bindValue(':product_image', $d['product_image']);
	$i->bindValue(':product_quantity', $d['product_quantity']);
	$i->bindValue(':product_model', $d['product_model']);
	$i->bindValue(':product_make', $d['product_make']);
	$i->bindValue(':product_color', $d['product_color']);
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

function fetch_sous_categories(){
	global $db;
	$query = "SELECT * FROM product_sous_categories";
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

//Fetch products by category
function fetch_products_by_maker($maker_id){
	global $db;
	$query = "SELECT * FROM products_tb WHERE product_make= :id";
	$result = $db->prepare($query);
	$result->execute(['id' => $maker_id]);
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

//Fetch products by color
function fetch_products_by_color($color_id){
	global $db;
	$query = "SELECT * FROM products_tb WHERE product_color= :id";
	$result = $db->prepare($query);
	$result->execute(['id' => $color_id]);
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

//fetch similar products to
function fetch_similar_products($product_id,$category_id, $limit){
	global $db;
	$query = "SELECT * FROM products_tb WHERE product_category= :id AND id != ".$product_id."
			  ORDER BY product_price ASC
			  LIMIT ".$limit." ";
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

//Fetch most viewed products with custom limit
function fetch_most_viewed_products($status, $limit){
	global $db;
	$query = "SELECT * FROM products_tb WHERE product_status= :status 
			  ORDER BY product_views DESC LIMIT ".$limit."";
	$result = $db->prepare($query);
	$result->execute(['status' => $status]);
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

//Fetch most saled products with custom limit
function fetch_most_saled_products($status, $limit){
	global $db;
	$query = "SELECT * FROM products_tb WHERE product_status= :status 
			  ORDER BY product_sales DESC LIMIT ".$limit."";
	$result = $db->prepare($query);
	$result->execute(['status' => $status]);
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

function insert_to_cart($product_id,$user_ip){
	global $db;
	$q = $db->prepare('INSERT INTO cart_tb(product_id,client_ip)
						  VALUES(:product_id, :client_ip)');
	$q->execute([
	'product_id' => $product_id,
	'client_ip' =>$user_ip
	]);
}

function remove_to_cart($order_id){
	global $db;
	$q = $db->prepare('DELETE FROM cart_tb WHERE id= :id');
	$q->execute([
	'id' => $order_id,
	]);
}

function fetch_client_cart($client_ip){
	global $db;
	$query = "SELECT * FROM cart_tb WHERE client_ip= :client_ip";
	$result = $db->prepare($query);
	$result->execute(['client_ip' => $client_ip]);
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

function search_for($keyword){
	global $db;

	$query = "SELECT * FROM product_categories WHERE designation like :designation";
	$result = $db->prepare($query);
	$result->execute(['designation' => '%'.$keyword.'%']);
	$categorie = $result->fetch(PDO::FETCH_ASSOC);

	$query = "SELECT * FROM products_tb WHERE product_name like :product_name";
	$result = $db->prepare($query);
	$result->execute(['product_name' => '%'.$keyword.'%']);
	$products = $result->fetchAll(PDO::FETCH_ASSOC);

	if(!empty($categorie)){
		$query = "SELECT products_tb.id AS product_id, product_name, product_description, product_price, product_image FROM products_tb INNER JOIN product_categories ON products_tb.product_category= product_categories.id 
		WHERE product_category = '".$categorie['id']."'
		ORDER BY products_tb.product_price ASC";
		$result = $db->prepare($query);
		$result->execute();
		$data = $result->fetchAll(PDO::FETCH_ASSOC);
	}else{
		return $products;
	}
	
	return $data;
}

function add_sous_category(array $d, $shop_id){
	global $db;
	
	$sql = 'INSERT INTO product_sous_categories (designation, shop_id,parent_id,status) 
			VALUES(:designation,:shop_id,:parent_id,:status)';
	
	$i = $db->prepare($sql);
	
	$i->bindValue(':designation', $d['designation']);
	$i->bindValue(':shop_id', $shop_id);
	$i->bindValue(':parent_id', $d['parent_id']);
	$i->bindValue(':status', $d['status']);
	$i->execute();
}

function add_make(array $d, $shop_id){
	global $db;
	
	$sql = 'INSERT INTO products_makes(designation, shop_id, state) 
			VALUES(:designation,:shop_id,:state)';
	
	$i = $db->prepare($sql);
	
	$i->bindValue(':designation', $d['make_designation']);
	$i->bindValue(':shop_id', $shop_id);
	$i->bindValue(':state', $d['status']);
	$i->execute();
}

function update_make(array $d, $make_id){
	global $db;
	$sql = 'UPDATE products_makes 
			SET designation= :designation,state= :status 
			WHERE id= :id';

	$i = $db->prepare($sql);
	$i->bindValue(':designation', $d['make_designation']);
	$i->bindValue(':status', $d['status']);
	$i->bindValue(':id', $make_id);
	if($i->execute()){
	return true;
	}
}

function fetch_category_details($category_id){
	global $db;
	$query = "SELECT * FROM product_categories WHERE id= :product_category";
	$result = $db->prepare($query);
	$result->execute(['product_category' => $category_id]);
	$data = $result->fetch(PDO::FETCH_ASSOC);
	return $data;
}

function update_scategory_status($sc_i, $status){
	global $db;
	
	$sql = 'UPDATE product_sous_categories SET status= :status 
			WHERE id= :id';
	
	$i = $db->prepare($sql);
	
	$i->bindValue(':status', $status);
	$i->bindValue(':id', $sc_i);
	$i->execute();
}

function update_make_status($m_i, $status){
	global $db;
	
	$sql = 'UPDATE products_makes SET state= :status 
			WHERE id= :id';
	
	$i = $db->prepare($sql);
	
	$i->bindValue(':status', $status);
	$i->bindValue(':id', $m_i);
	$i->execute();
}

function update_sous_category(array $d, $sc_i){
	global $db;
	
	$sql = 'UPDATE product_sous_categories 
			SET designation= :designation,parent_id= :parent_id,status= :status 
			WHERE id= :id';

	$i = $db->prepare($sql);
	$i->bindValue(':designation', $d['designation']);
	$i->bindValue(':parent_id', $d['parent_id']);
	$i->bindValue(':status', $d['status']);
	$i->bindValue(':id', $sc_i);
	if($i->execute()){
	return true;
	}
}

function fetch_sous_category_details($sc_i){
	global $db;
	$query = "SELECT * FROM product_sous_categories WHERE id= :id";
	$result = $db->prepare($query);
	$result->execute(['id' => $sc_i]);
	$data = $result->fetch(PDO::FETCH_ASSOC);
	return $data;
}

function fetch_model_details($m_i){
	global $db;
	$query = "SELECT * FROM products_makes WHERE id= :id";
	$result = $db->prepare($query);
	$result->execute(['id' => $m_i]);
	$data = $result->fetch(PDO::FETCH_ASSOC);
	return $data;
}

//Fetch products with tri price 
function fetch_with_price_tri_products($status, $limit,$code){
	global $db;
	$query = '';
	if($code == 0){
	$query = "SELECT * FROM products_tb WHERE product_status= :status 
			  ORDER BY product_price ASC LIMIT ".$limit."";
	}else if($code == 1){
	$query = "SELECT * FROM products_tb WHERE product_status= :status 
		ORDER BY product_price DESC LIMIT ".$limit."";
	}
	
	$result = $db->prepare($query);
	$result->execute(['status' => $status]);
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

//Fetch 
function fetch_with_maker_tri_products($status, $limit,$product_make,$color_id,$code){
	global $db;
	$query = '';
	if($code == 0){
	$query = "SELECT * FROM products_tb WHERE product_status= :status AND product_make= :product_make
			  ORDER BY product_price ASC LIMIT ".$limit."";
			  $result = $db->prepare($query);
			  $result->execute([
				  'status' => $status,
				  'product_make' => $product_make
			  ]);
	}else if($code == 1){
		$query = "SELECT * FROM products_tb 
		WHERE product_status= :status AND product_make= :product_make AND product_color= :product_color
		ORDER BY product_price ASC LIMIT ".$limit."";
		$result = $db->prepare($query);
		$result->execute([
			'status' => $status,
			'product_make' => $product_make,
			'product_color' => $color_id
		]);
	}
	
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

function fetch_colors($status){
	global $db;
	$query = "SELECT * FROM colors_tb WHERE state= :state ";
	$result = $db->prepare($query);
	$result->execute(['state'=>$status]);
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

function fetch_products_makes($status){
	global $db;
	if($status == 3){
	$query = "SELECT * FROM products_makes";
	$result = $db->prepare($query);
	$result->execute();
	}else{
	$query = "SELECT * FROM products_makes  WHERE state= :state";
	$result = $db->prepare($query);
	$result->execute(['state'=>$status]);
	}
	
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

function fetch_products_colors($status){
	global $db;
	if($status == 3){
	$query = "SELECT * FROM colors_tb";
	$result = $db->prepare($query);
	$result->execute();
	}else{
	$query = "SELECT * FROM colors_tb  WHERE state= :state";
	$result = $db->prepare($query);
	$result->execute(['state'=>$status]);
	}
	
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

function fetch_sous_category_by_parent_id($parent_id){
	global $db;
	$query = "SELECT * FROM product_sous_categories WHERE parent_id= :parent_id";
	$result = $db->prepare($query);
	$result->execute(['parent_id' => $parent_id]);
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}