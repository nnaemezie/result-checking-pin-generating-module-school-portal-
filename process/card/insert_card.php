<?php

	if (isset($_POST['qty'])) {

    function checkSchool($schoolType){
      if ($schoolType == 'owalla') {
        require_once('../config/configOwalla.php');
      }
    }

    $schoolType = $_POST['schoolType'];
    checkSchool($schoolType);
    require_once('../database.php');

		$qty = $_POST['qty'];
		$index = 1;
		$notadded=0;
		$added = 0;
		while( $index <= $qty ){

			$rand1 = rand(1000000000, 9999999999);
			$rand2 = rand(100000000000000, 999999999999999);
			$pin 	= $rand1;
			$serial = $rand2;

			$sql = "SELECT * FROM card WHERE pin = '$pin' ";
			$result = $database->query($sql);

			if ($result->num_rows > 0) {
				$notadded++;
			}else{
				$sql = "INSERT INTO card(term, session, pin, serial_pin, matchid, class) VALUES('', '', '$pin', '$serial', '', '')";
				if($database->query($sql)){
					$sql1 = "INSERT INTO card_print(pin, serial) VALUES('$pin', '$serial')";
					if($database->query($sql1)){
						$added++;
					}
				}
				$index ++;
			}

		}
		$index = $index -1 ;

		// echo '
		// 	<div class="alert alert-success">
    //           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    //           <strong>Success!</strong> '.$added.' was generated.
    //         </div>
		// ';
    echo $added.' was generated';
	}
