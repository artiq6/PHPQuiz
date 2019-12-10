<?php
include("../Config.php");
if ($_POST['action'] == 'quiz') {	
	
	
	$user_check=$_POST['user'];
	$a=$_POST['array'];
	$q=$_POST['answers'];

	$allConnections=true;
	
	//points
	$pts = 0;

	for ($i = 0; $i < 10; $i++) {
		if ($q[$i] == $a[$i]['correct']) {
			$pts++;
			//+1 to correct_answers
			$total = $a[$i]['correct_answers'] + 1;
			$sql = "UPDATE questions SET `correct_answers`=$total WHERE id='" . $a[$i]['id'] . "'";
			$conn->query($sql);
			if(!$conn->query($sql)==="TRUE"){
				$allConnections=false;
			}
		}
	}

	$sql = "select * from users where login = '$user_check'";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
	}
	$total_answers = $row['all_answers'] + 10;
	$total_correct = $row['correct_answers'] + $pts;
	$sql = "UPDATE users SET correct_answers=$total_correct, all_answers=$total_answers WHERE id='" . $row['id'] . "'";
	$conn->query($sql);
	if(!$conn->query($sql)==="TRUE"){
		$allConnections=false;
	}


	if($allConnections) {
		$data = array(	
			"status" => 1,
			"pts" =>$pts,
		); 
		echo json_encode($data);
	}
}
?>