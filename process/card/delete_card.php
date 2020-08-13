<?php

	if (isset($_POST['user_id'])) {

    function checkSchool($schoolType){
      if ($schoolType == 'owalla') {
        require_once('../config/configOwalla.php');
      }
    }

    $schoolType = $_POST['schoolType'];
    checkSchool($schoolType);
    require_once('../database.php');

		$user_id = $_POST['user_id'];

		$sql = "DELETE FROM card WHERE id = $user_id ";
		$database->query($sql);
	}
