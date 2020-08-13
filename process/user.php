<?php

	//output msg variable
	$msg = '';

	//school checker
	function checkSchool($schoolType){
		if ($schoolType == 'owalla') {
			require_once('config/configOwalla.php');
		}
	}

	//loads class to result checking form
	if (isset($_POST['loadClass'])) {

		$data = array();
		$schoolType = $_POST['schoolType'];
		checkSchool($schoolType);
		require_once('database.php');

		$sql = "SELECT * FROM class";
		$result = $database->query($sql);
		if ($result->num_rows > 0) {
			$output = '<option value="">Please Select Class</option>';
			while ($row = $result->fetch_assoc()) {
				$output .= '<option value="'.$row["level"].$row["name"].'">'.$row["level"].$row["name"].'</option>';
			}
			$data['class'] = $output;
		}

		$sql = "SELECT * FROM term ORDER BY session DESC";
		$result = $database->query($sql);
		if ($result->num_rows > 0) {
			$output = '<option value="">Please Select Term</option>';
			while ($row = $result->fetch_assoc()) {
				$output .= '<option value="'.$row["termtype"].' '.$row["session"].'">'.$row["termtype"].' '.$row["session"].'</option>';
			}
			$data['term'] = $output;
		}
		echo json_encode($data);
	}
	//login_form
	if(isset($_POST['login'])){
		$schoolType = $_POST['schoolType'];
		checkSchool($schoolType);
		require_once('database.php');

		$username = $database->escape_string($_POST['username']);
		$password = md5($database->escape_string($_POST['password']));
		$schoolType = $database->escape_string($_POST['schoolType']);

		$employee_data = " SELECT * FROM employee_data where admno = '$username' && password = '$password' && role = 'System Admin'  ";

		$result_employee = $database->query($employee_data);

		if($result_employee->num_rows == 1){
			$row = $result_employee->fetch_assoc();
			$_SESSION['sd'] = $row;
			$_SESSION['schoolType'] = $schoolType;
			$msg = 'success';
		}else{
			$msg = 'login error ! username or password incorrect.';
		}

		$data = array();
		$data['msg'] = $msg;
		$data['schoolType'] = $schoolType;

		echo json_encode($data);
	}
