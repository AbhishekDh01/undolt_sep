<?php 
	require_once 'connect.php';
	$tid = $_POST['tid'];

	$to = $_POST['tEmail'];
	$from = "no_reply@undolt.in";
	$name = $_POST['tName'];

	if(isset($_POST['tApprove'])){
		$sql1 = "update undolt.tutor set approved ='".$_POST['tApprove']."' where tid = $tid;";
		$stmt1 = $conn->prepare($sql1);

		try{
			$stmt1->execute();

		}catch(PDOException $e){
			myAlert("Internal Error");
			header("refresh:0; url= adminApproveTutor.php");
		}

		// mail

		ini_set( 'display_errors', 1 );
		error_reporting( E_ALL );

         $subject = "Congratulations";
         
         $message = "
					<html>
					<head>
					<title>Tutor Approval</title>
					</head>
					<body>
					<h2>Congratulations Tutor $name you have been selected</h2>

					<p>dash dash...</p>

					<p>Policy:</p>
					</body>
					</html>
					";

		$headers = "From:" . $from. "\r\n";
		$headers .= "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		if(mail($to,$subject,$message, $headers)) {
		    myAlert("Approval Email sent");
		} else {
		    myAlert("Error in sending email");
		}

		header("refresh:0; url= adminApproveTutor.php");

	}

	if(isset($_POST['tDisapprove'])){
		$stmt2 = $conn->prepare("DELETE FROM undolt.tutor where tid=:t;");
		$stmt2->bindParam(':t',$tid);
		$stmt2->execute();

		if(!$stmt2->rowCount()){
			myAlert("Some Internal Error Occured");
			header("refresh:0; url= adminApproveTutor.php");
		}else
			myAlert("Tutor Disapproved");
			
			
		// mail

		ini_set( 'display_errors', 1 );
		error_reporting( E_ALL );

         $subject = "Congratulations";
         
         $message = "
					<html>
					<head>
					<title>Tutor Disapproval</title>
					</head>
					<body>
					<h2> Tutor $name you have been not selected</h2>

					<p>dash dash...</p>

					<p>Policy:</p>
					</body>
					</html>
					";

		$headers = "From:" . $from. "\r\n";
		$headers .= "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		if(mail($to,$subject,$message, $headers)) {
		    myAlert("Disapproval Email sent");
		} else {
		    myAlert("Error in sending email");
		}

		header("refresh:0; url= adminApproveTutor.php");
		
	}

	


?>

<?php
function myAlert($msg){
	echo "<script>alert('$msg');</script>";
}

?>