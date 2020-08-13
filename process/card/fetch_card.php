<?php
  function checkSchool($schoolType){
    if ($schoolType == 'owalla') {
      require_once('../config/configOwalla.php');
    }
  }

  $schoolType = $_POST['schoolType'];
  checkSchool($schoolType);
  require_once('../database.php');

  $sql = "SELECT * FROM card ORDER BY id DESC";
  $result = $database->query($sql);
  if ($result->num_rows > 0) {
		echo '
        <table class="table table-bordered" id="user_data">
    			<thead>
    	            <th>S/N</th>
    	            <th>Term</th>
                  <th>Session</th>
    	            <th>PIN</th>
    	            <th>Serial</th>
    	            <th>Match ID</th>
    ';
    if($_SESSION['sd']['super_admin'] == 'YES'){
    	      echo '<th></th>';
    }
    echo '
	        </thead>
	        <tbody>
	    ';

		$cnt=1;
		while ($row = $result->fetch_assoc()) {
			echo '
				<tr>
					<td>'.$cnt++.'</td>
	                <td>'.$row["term"].'</td>
                  <td>'.$row["session"].'</td>
	                <td>'.$row["pin"].'</td>
	                <td>'.$row["serial_pin"].'</td>
	                <td>'.$row["matchid"].'</td>
      ';
          if($_SESSION['sd']['super_admin'] == 'YES'){
	          echo '<td>
	                	<button type="button" class="btn btn-danger btn-xs delete" id="'.$row["id"].'"><i class="fa fa-trash"></i></button>
	                </td>';
          }
  echo '</tr>';
		}
		echo '
          </tbody>
      </table>
        ';

	}else{
		echo "No Record Found in the Database";
	}
?>

<script type="text/javascript">
	$('#user_data').DataTable();
</script>
