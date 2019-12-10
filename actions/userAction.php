<?php
include("../Config.php");
if ($_POST['action'] == 'edit' && $_POST['id']) {	
	$updateField='';
	if(isset($_POST["login"])) {
		$updateField.= "login='".$_POST["login"]."'";
	}if(isset($_POST['admin'])) {
		$updateField.= ",admin='".$_POST['admin']."'";
	}

	if($updateField && $_POST['id']) {
		$sql = "UPDATE users SET $updateField WHERE id='" . $_POST['id'] . "'";	
		if ($conn->query($sql) === TRUE) {//succes
		} 
		$data = array(
			"message"	=> "Record Updated",	
			"status" => 1,
			"SQL" => $sql
		); 
		echo json_encode($data);
		$conn->close();		
	}
}
if ($_POST['action'] == 'delete' && $_POST['id']) {
	$sql = "DELETE FROM users WHERE id='" . $_POST['id'] . "'";	
	if($conn->query($sql)===TRUE){
		echo "<p class='text-success text-center'>Edit complete</p>";
	}else {//error
		echo "<p class='text-danger text-center'>Error($conn)<p>";
	}
	$data = array(
		"message"	=> "Record Deleted",	
		"status" => 1
	);
	$conn->close();	
	echo json_encode($data);	
}
?>