<?php

include("connection.php");
function userData($con)
{

	if(isset($_SESSION['user_id']))
	{

		$id = $_SESSION['user_id'];
		$query = "select * from users where id = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
			header("Location: index.php");
			die;
		}
	}

}
function taskData($con, $id){
	$query = "SELECT * FROM tasks WHERE id='$id'";
	$result = mysqli_query($con, $query);
	$data = mysqli_fetch_assoc($result);
	return $data;
}
function mailData($con, $id){
	$query = "SELECT * FROM mail WHERE id='$id'";
	$result = mysqli_query($con, $query);
	$data = mysqli_fetch_assoc($result);
	return $data;
}

function tasksToDoCount($con, $group){
	$query = "SELECT * FROM tasks WHERE groups='$group' AND ended='0'";
	$result = mysqli_query($con, $query);
	return mysqli_num_rows($result);
}
function newMailsCount($con, $send_to){
	$query = "SELECT * FROM mail WHERE send_to='$send_to' AND seen='0'";
	$result = mysqli_query($con, $query);
	return mysqli_num_rows($result);
}


function userTableLenght($con){
    $query = "SELECT * FROM users";
    $result = mysqli_query($con, $query);
    $num = mysqli_num_rows($result);
    return $num;
}
function findUser($con, $id){
    $query = "SELECT * FROM users WHERE id='$id'";
    $result = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($result);
    return $data;
}
function findLatestID($con){
	$query = "SELECT * FROM users ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($con, $query);
	$data = mysqli_fetch_assoc($result);
	return $data;
}
function findLatestTaskID($con){
	$query = "SELECT * FROM tasks ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($con, $query);
	$data = mysqli_fetch_assoc($result);
	return $data;
}
function findFirstTaskID($con){
	$query = "SELECT * FROM tasks ORDER BY id ASC LIMIT 1";
	$result = mysqli_query($con, $query);
	$data = mysqli_fetch_assoc($result);
	return $data;
}
function findTask($con, $id){
	$query = "SELECT * FROM tasks WHERE id='$id'";
    $result = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($result);
    return $data;
}
function findMail($con, $id){
	$query = "SELECT * FROM mail WHERE id='$id'";
    $result = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($result);
    return $data;
}
function findLatestMailID($con){
	$query = "SELECT * FROM mail ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($con, $query);
	$data = mysqli_fetch_assoc($result);
	return $data;
}
function findFirstMailID($con){
	$query = "SELECT * FROM mail ORDER BY id ASC LIMIT 1";
	$result = mysqli_query($con, $query);
	$data = mysqli_fetch_assoc($result);
	return $data;
}
function groups($con, $group){
	$query = "SELECT * FROM users WHERE groups='$group'";
	$result = mysqli_query($con, $query);
	return mysqli_num_rows($result);
}