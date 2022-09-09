<?php 
require_once 'connect.php';
if(isset($_POST['tReg'])){


	$sql = "INSERT INTO undolt.tutor(tName,tEmail,tContact,tPass,approved,tsubject,rating,vkey) VALUES(:n,:e,:c,:p,:a,:s,:r,:v)";
	$pass = md5($_POST['tPass']);
	$stmt = $conn->prepare($sql);
	$vkey = md5(time());

	try{
		
	$stmt->execute(
		array(
			':n' => $_POST['tName'], 
			':e' => $_POST['tEmail'],
			':c' => $_POST['tContact'],
			':p' => $pass,
			':a' => 'Pending',
			':s' => $_POST['tsubject'],
			':r' => 0,
			':v' => $vkey
		)
	);

	verificationEmail('no_reply@undolt.com','tid',$tEmail,$vkey,'https://abhi.oneshopy.in/verifyAccount.php');

	myAlert("Verification mail send. We will contact you shortly");
	$tEmail = $_POST['tEmail'];
	$stmt = $conn->query("SELECT tid FROM undolt.tutor where tEmail='$tEmail';");
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	
	session_start();

	$_SESSION['Navtid'] = $row['tid'];

	header("refresh:0; url= tutorLogin.php");
    exit();
	}catch(PDOException $e){
	myAlert("Already registered user");
	header("refresh:0; url= tutorReg.html");
	}
	
}

?>
<?php
function myAlert($msg){
	echo "<script>alert('$msg');</script>";
}

?>