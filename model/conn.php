<?php

try {
	$db = new PDO('mysql:host=localhost;dbname=one-market;charset=utf8', 'root', '');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $db;
} catch (PDOException $e) {
	die('Error when connecting to database: ' . $e->getMessage());
}

function get_rate()
{
	global $db;
	$sql = "SELECT cdf FROM rates ORDER BY id DESC LIMIT 1 ";
	$result = $db->prepare($sql);
	$result->execute();
	$data = $result->fetch();
	return $data['cdf'];
}

function f_exists($table, $field, $value)
{
	global $db;

	$sql = 'SELECT COUNT(*) FROM ' . $table . ' WHERE ' . $field . ' = ?';
	
	$q = $db->prepare($sql);
	
	$q->execute([$value]);
	
	return ! $q->fetchColumn();var_dump(microtime());
}

function login($table, $username, $password)
{
	global $db;
	
	$sql = "SELECT * FROM $table WHERE (username = :un OR email = :un) AND password = :pass";
	
	$q = $db->prepare($sql);
	$q->bindValue(':un', $username);
	$q->bindValue(':pass', sha1($password));
	
	$q->execute();
		
	return $q->fetch(\PDO::FETCH_ASSOC);
}

function register($table, $fullname, $telephone, $birth_date, $emailadress, $password)
{
	global $db;
	
	$q=$db->prepare('INSERT INTO users(username,phone_number,birth_date,email,password)
	                 VALUES(:username,:phone_number,:birth_date,:email,:password)');
	$q->execute([
	'username'=> $fullname,
	'phone_number'=>$telephone,
	'birth_date'=>$birth_date,
	'email'=>$emailadress,
	'password'=>$password
	]);

	$last_id = $db->lastInsertId();
		
	$sql = "SELECT * FROM $table WHERE id= :id";
	$q = $db->prepare($sql);
	$q->bindValue(':id', $last_id);
	
	$q->execute();
		
	return $q->fetch(\PDO::FETCH_ASSOC);
}

function get_firm_name($firm_id)
{
	global $db;
	$query = "SELECT name FROM firms WHERE id = ?";
	$result = $db->prepare($query);
	$result->execute(array($firm_id));
	$data = $result->fetch();
	return $data['name'];
}

function get_all_data($table, $firm_id)
{
	global $db;
	
	$sql = 'SELECT * FROM ' . $table.' WHERE firm_id = '.$firm_id;
	
	$q = $db->query($sql);
		
	return $q->fetchAll(\PDO::FETCH_ASSOC);
}

function verify_existing_data($table, $field, $value)
{
	global $db;
	$query = "SELECT * FROM ".$table." WHERE ".$field." = ?";
	$result = $db->prepare($query);
	$result->execute(array($value));
	$data = $result->fetchAll(PDO::FETCH_ASSOC);
	return $data;
}

//For Searching The info about where user works we must have : the table and the id
function get_user_entity_info($table, $entity_id)
{
	global $db;
	$query = "SELECT * FROM ".$table." WHERE id = ?";
	$result = $db->prepare($query);
	$result->execute(array($entity_id));
	$data = $result->fetch();
	return $data;
}

function get_listed_data($table, $offset, $limit)
{
	global $db;
	
	$sql = 'SELECT * FROM ' . $table . ' ORDER BY id DESC LIMIT ' . (int) $offset . ', ' . (int) $limit;
	
	$q = $db->query($sql);
		
	return $q->fetchAll(\PDO::FETCH_ASSOC);
}

function find($table, $id)
{
	global $db;
	
	$sql = 'SELECT * FROM ' . $table . ' WHERE id = ' . (int) $id;
	
	$q = $db->query($sql);
		
	return $q->fetch(\PDO::FETCH_ASSOC);
}

function delete_row($table, $id)
{
	global $db;
	
	$sql = 'DELETE FROM ' . $table . ' WHERE id = ' . (int) $id;
	
	$q = $db->exec($sql);
}

function cur_rate()
{
	global $db;

	$sql = 'SELECT cdf FROM Rates ORDER BY id DESC LIMIT 1';

	$q = $db->query($sql);

	return $q->fetch(\PDO::FETCH_COLUMN);
}
