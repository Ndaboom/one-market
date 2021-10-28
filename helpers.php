<?php

function resize_image($path)
{
	require_once('vendor/php-image-resize-master/php-image-resize-master/lib/ImageResize');
	
	$image_resize = new Eventviva\ImageResize();
	
	$image_resize->save($path);
	
	unlink($path);
}

function val_str($str, $min_len = 1, $max_len = 100000)
{
	if ( ! is_string($str)) {
		return false;
	}
	
	$str_len = strlen($str);
	
	return $str_len >= $min_len && $str_len <= $max_len;
}

function val_empty($str)
{
	return ! empty($str) && ! trim($str) == '';
}

function val_date($date)
{
	try {
		new \DateTime($date);
		return true;
	} catch(\Exception $e) {
		return false;
	}
}

function val_email($email)
{
	return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
}

function val_url($url)
{
	return (bool) filter_var($url, FILTER_VALIDATE_URL);
}

function val_img($img)
{
	if ($img['error'] == 0) {
		if (strpos($img['type'], 'image/') !== false) {
			return true;
		}
	}
	
	return false;
}

function val_phone($phone)
{
	// Put validation code here
	return true;
}

function val_password($password)
{
	return strlen($password) >= 5;
}

function get_errors(array $errors)
{
	$errors = array_filter($errors, function($e) {
		return false == $e;
	});
	
	if ($errors) {
		foreach ($errors as $k => $v) {
			$errors[$k] = true;
		}
	}
	
	return $errors;
}

function save_file($file, $path)
{
	$file_parts = explode('/', $file['type']);
	$filename = md5(microtime() . basename($file['name'])) . '.' . $file_parts[1];
	
	if (move_uploaded_file($file['tmp_name'], __DIR__ . '/' . $path . '/' . $filename)) {
		return $filename;
	}
	
	return false;
}

function is_method($method)
{
	return (string) strtoupper($method) == $_SERVER['REQUEST_METHOD'];
}

function get_msgs()
{
	$ret = '';
	
	foreach ($_SESSION['flash'] as $msg) {
		$ret .= '<div class="alert alert-success alert-dismissible " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
                    </button>' . $msg .
                '</div>';
	}
	
	
	unset($_SESSION['flash']);
}

function get_msg_at($at)
{
	if (isset($_SESSION['flash_at'][$at])) 
	{
		$msg = '<div class="alert alert-success alert-dismissible " role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">×</span>
                    </button>' . $_SESSION['flash_at'][$at] .
                '</div>';
				
		unset($_SESSION['flash_at'][$at]);
		return $msg;
	}
}
function create_msg($msg)
{
	$_SESSION['flash'][] = $msg;
}

function create_msg_at($at, $msg, $color = 'primary')
{
	$_SESSION['flash_at'][$at] = $msg;
	$_SESSION['flash_color'] = $color;
}

function set_session($key, $value)
{
	$_SESSION[$key] = $value;
}

function get_session($key)
{
	if (session_exists($key)) {
		return $_SESSION[$key];
	}
	
	return false;
}

function is_it_exists($table, $field, $value)
{
	$result = verify_existing_data($table, $field, $value);
	return $result;
}

function session_exists($key)
{
	return (bool) array_key_exists($key, $_SESSION);
}

function remove_session($key)
{
	if (session_exists($key)) {
		unset($_SESSION[$key]);
	}
}

function redirect($url)
{
	global $base;
	header('Location: ' . $base . $url);
	exit();
}


function is_empty($fields = "array()")
{
	for ($i=0; $i < $fields->length(); $i++) { 
		if(empty($fields[$i]))
		{
			echo "Empty";
		}
		else
		{
			echo "None empty";
		}
	}
}

function validate_empty($fields)
{
	for($i=0; $i<count($fields); $i++)
	{
		if (empty($fields[$i]) || trim($fields[$i]) == '')
			return false;
	}
	return true;
}

// -------------------------- random users  ----------------------------//
function random_number()
{
    $random = mt_rand(1,100000); 
    $random_2 = $random * 8888;
    $final_random = substr(($random_2 ),0,8 );
    return $final_random;
}
//---------------------------------------------------------------//



function html_value_attr($value, $array = [])
{
	if ($array) {
		return array_key_exists($value, $array)? 'value="' . $array[$value] . '"': '';
	}
		
	if (is_method('POST')) {
		return 'value="' . $_POST[$value] . '"';
	}
}

function capitalize($text)
{
	return mb_convert_case($text, MB_CASE_TITLE, 'UTF-8');
}