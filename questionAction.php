<?php
include("Config.php");
if ($_POST['action'] == 'edit' && $_POST['id']) {	
	$updateField='';
	if(isset($_POST["question"])) {
		$updateField.= "question='".$_POST["question"]."'";
	}if(isset($_POST['a'])) {
		$updateField.= ",a='".$_POST['a']."'";
	}if(isset($_POST['b'])) {
		$updateField.= ",b='".$_POST['b']."'";
	}if(isset($_POST['c'])) {
		$updateField.= ",c='".$_POST['c']."'";
	}if(isset($_POST['d'])) {
		$updateField.= ",d='".$_POST['d']."'";
	}if(isset($_POST['correct'])) {
		$updateField.= ",correct='".$_POST['correct']."'";
	}
	echo $updateField;
	if($updateField && $_POST['id']) {
		$sql = "UPDATE questions SET $updateField WHERE id='" . $_POST['id'] . "'";	
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
	$sql = "DELETE FROM questions WHERE id='" . $_POST['id'] . "'";	
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