<?php 
require_once 'connect.php';
if(isset($_POST['mReg'])){


	$sql = "INSERT INTO undolt.manager(mName,mEmail,mContact,mPass,approved) VALUES(:n,:e,:c,:p,:a)";
	$pass = md5($_POST['mPass']);
	$stmt = $conn->prepare($sql);

	try{
		
	$stmt->execute(
		array(
			':n' => $_POST['mName'], 
			':e' => $_POST['mEmail'],
			':c' => $_POST['mContact'],
			':p' => $pass,
			':a' => 'No',
		)
	);

	myAlert("We will get back to you shortly.");
	$mEmail = $_POST['mEmail'];
	$stmt = $conn->query("SELECT mid FROM undolt.manager where mEmail='$mEmail';");
	$row=$stmt->fetch(PDO::FETCH_ASSOC);
	
	session_start();

	$_SESSION['Navmid'] = $row['mid'];

	header("refresh:1; url= managerLogin.php");
    exit();
	}catch(PDOException $e){
	myAlert("Already registered.");
	header("refresh:1; url= ManagerLogin.php");
	exit();
	}
	
}

?>
<?php
function myAlert($msg){
	echo "<script>alert('$msg');</script>";
}

?>