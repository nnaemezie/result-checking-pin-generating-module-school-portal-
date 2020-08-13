<?php

	if (isset($_POST['wipe'])) {

    function checkSchool($schoolType){
      if ($schoolType == 'owalla') {
        require_once('../config/configOwalla.php');
      }
    }

    $schoolType = $_POST['schoolType'];
    checkSchool($schoolType);
    require_once('../database.php');

		$sql = "TRUNCATE card_print";
		$database->query($sql);

	}
