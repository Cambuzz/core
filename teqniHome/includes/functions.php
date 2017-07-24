<?php
function mysql_prep($string) {
	global $conn;
	$escaped_string = mysqli_real_escape_string($conn, $string);
	return $escaped_string;
}
function confirm_query($result_set) {
	if (!$result_set) {
		die("Database query failed.");
	}
}
function find_all_users() {
	global $conn;

	$query = "SELECT * ";
	$query .= "FROM users ";
	$query .= "ORDER BY username ASC";
	$user_set = mysqli_query($conn, $query);
	confirm_query($user_set);
	return $user_set;
}
function find_user_by_id($user_id) {
	global $conn;

	$safe_user_id = mysqli_real_escape_string($conn, $user_id);

	$query = "SELECT * ";
	$query .= "FROM users ";
	$query .= "WHERE id = {$safe_user_id} ";
	$query .= "LIMIT 1";
	$user_set = mysqli_query($conn, $query);
	confirm_query($user_set);
	if ($user = mysqli_fetch_assoc($user_set)) {
		return $user;
	} else {
		return null;
	}
}

function password_encrypt($password) {
	$hash_format = "$2y$10$";
	$salt_length = 22;
	$salt = generate_salt($salt_length);
	$format_and_salt = $hash_format . $salt;
	$hash = crypt($password, $format_and_salt);
	return $hash; 
}
function generate_salt($length) {
	$unique_random_string = md5(uniqid(mt_rand(), true));
	$base64_string = base64_encode($unique_random_string);
	$modified_base64_string = str_replace('+', '.', $base64_string);
	$salt = substr($modified_base64_string, 0, $length);
	return $salt;
}
function password_check($password, $existing_hash) {
$hash = crypt($password, $existing_hash);
if ($hash === $existing_hash) {
	return true;
} else {
	return false;
}
}
function find_user_by_username($username) {
	global $conn;
	$safe_username = mysqli_real_escape_string($conn, $username);

	$query = "SELECT * ";
	$query .= "FROM users ";
	$query .= "WHERE username = '{$safe_username}' ";
	$query .= "LIMIT 1";
	$user_set = mysqli_query($conn, $query);
	confirm_query($user_set);
	if ($user = mysqli_fetch_assoc($user_set)) {
		return $user;
	} else {
		return null;
	}
}

function attempt_login($username, $password) {
	$user = find_user_by_username($username);
	if ($user) {
		if (password_check($password, $user["hashed_password"])) {
			return $user;
		} else {
			return false;
		}
	} else {
		return false;
	}
}
?>