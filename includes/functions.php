<?php
function redirect_to($new_location) {
	header("Location: " . $new_location);
	exit; 
}
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
function form_errors ($errors=array()) {
	$output = "";
	if (!empty($errors)) {
		$output .= "<div class=\"error\">";
		$output .= "Please fix the following errors:";
		$output .= "<ul>";
		foreach ($errors as $key => $error) {
			$output .= "<li>";
			$output .= htmlentities($error);
			$output .= "</li>";
		}
		$output .= "</ul>";
		$output .= "</div>";
	}
	return $output;
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

function find_all_admins() {
	global $conn;

	$query = "SELECT * ";
	$query .= "FROM admins ";
	$query .= "ORDER BY username ASC";
	$admin_set = mysqli_query($conn, $query);
	confirm_query($admin_set);
	return $admin_set;
}
function find_admin_by_id($admin_id) {
	global $conn;

	$safe_admin_id = mysqli_real_escape_string($conn, $admin_id);

	$query = "SELECT * ";
	$query .= "FROM admins ";
	$query .= "WHERE id = {$safe_admin_id}";
	$query .= "LIMIT 1";
	$admin_set = mysqli_query($conn, $query);
	confirm_query($admin_set);
	if ($admin = mysqli_fetch_assoc($admin_set)) {
		return $admin;
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
function find_admin_by_username($username) {
	global $conn;
	$safe_username = mysqli_real_escape_string($conn, $username);

	$query = "SELECT * ";
	$query .= "FROM admins ";
	$query .= "WHERE username = '{$safe_username}' ";
	$query .= "LIMIT 1";
	$admin_set = mysqli_query($conn, $query);
	confirm_query($admin_set);
	if ($admin = mysqli_fetch_assoc($admin_set)) {
		return $admin;
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
function attempt_admin_login($username, $password) {
	$admin = find_admin_by_username($username);
	if ($admin) {
		if (password_check($password, $admin["hashed_password"])) {
			return $admin;
		} else {
			return false;
		}
	} else {
		return false;
	}
}
function logged_in() {
	return isset($_SESSION['user_id']);
}
function admin_logged_in() {
	return isset($_SESSION['admin_id']);
}
function confirm_logged_in() {
	if (!logged_in()) {
		redirect_to("../../index.php");
	}
}
function confirm_admin_logged_in() {
	if (!admin_logged_in()) {
		redirect_to("logincontrol.php");
	}
}
function zeros($rowCount, $colCount){
    $matrix = array();
    for ($rowIndx=0; $rowIndx<$rowCount; $rowIndx++){
        $matrix[] = array();
        for($colIndx=0; $colIndx<$colCount; $colIndx++){
            $matrix[$rowIndx][$colIndx]=0;
        }
    }
    return $matrix;
}
function find_all_teachers() {
	global $conn;

	$query = "SELECT * ";
	$query .= "FROM teacher ";
	$query .= "ORDER BY name ASC";
	$teacher_set = mysqli_query($conn, $query);
	confirm_query($teacher_set);
	return $teacher_set;
}
function find_teacher_by_id($teacher_id) {
	global $conn;

	$safe_teacher_id = mysqli_real_escape_string($conn, $teacher_id);

	$query = "SELECT * ";
	$query .= "FROM teacher ";
	$query .= "WHERE id = {$safe_teacher_id} ";
	$query .= "LIMIT 1";
	$teacher_set = mysqli_query($conn, $query);
	confirm_query($teacher_set);
	if ($teacher = mysqli_fetch_assoc($teacher_set)) {
		return $teacher;
	} else {
		return null;
	}
}
function find_all_questions() {
	global $conn;

	$query = "SELECT * ";
	$query .= "FROM quora ";
	$query .= "ORDER BY id DESC";
	$question_set = mysqli_query($conn, $query);
	confirm_query($question_set);
	return $question_set;
}
function find_question_by_id($question_id) {
	global $conn;

	$safe_question_id = mysqli_real_escape_string($conn, $question_id);

	$query = "SELECT * ";
	$query .= "FROM quora ";
	$query .= "WHERE id = {$safe_question_id} ";
	$query .= "LIMIT 1";
	$question_set = mysqli_query($conn, $query);
	confirm_query($question_set);
	if ($question = mysqli_fetch_assoc($question_set)) {
		return $question;
	} else {
		return null;
	}
}
function find_all_events() {
	global $conn;

	$query = "SELECT * ";
	$query .= "FROM notify ";
	//$query .= "ORDER BY username ASC";
	$event_set = mysqli_query($conn, $query);
	confirm_query($event_set);
	return $event_set;
}
function find_event_by_id($event_id) {
	global $conn;

	$safe_event_id = mysqli_real_escape_string($conn, $event_id);

	$query = "SELECT * ";
	$query .= "FROM notify ";
	$query .= "WHERE id = {$safe_event_id} ";
	$query .= "LIMIT 1";
	$event_set = mysqli_query($conn, $query);
	confirm_query($event_set);
	if ($event = mysqli_fetch_assoc($event_set)) {
		return $event;
	} else {
		return null;
	}
}
function find_all_answers() {
	global $conn;

	$query = "SELECT * ";
	$query .= "FROM answers ";
	//$query .= "ORDER BY username ASC";
	$answer_set = mysqli_query($conn, $query);
	confirm_query($answer_set);
	return $answer_set;
}
function find_answer_by_id($answer_id) {
	global $conn;

	$safe_answer_id = mysqli_real_escape_string($conn, $answer_id);

	$query = "SELECT * ";
	$query .= "FROM answers ";
	$query .= "WHERE id = {$safe_answer_id} ";
	$query .= "LIMIT 1";
	$answer_set = mysqli_query($conn, $query);
	confirm_query($answer_set);
	if ($answer = mysqli_fetch_assoc($answer_set)) {
		return $answer;
	} else {
		return null;
	}
}
function find_all_muns() {
	global $conn;

	$query = "SELECT * ";
	$query .= "FROM mun ";
	$query .= "ORDER BY id DESC";
	$mun_set = mysqli_query($conn, $query);
	confirm_query($mun_set);
	return $mun_set;
}
?>