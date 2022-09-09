<?php
  require_once 'connect.php';
  if(isset($_POST['sLogin'])){
  		$sql = "SELECT * from undolt.student where sEmail = :e";
		$pass = md5($_POST['sPass']);
		$stmt = $conn->prepare($sql);
		$stmt->bindParam(':e',$_POST['sEmail']);
		$stmt->execute();

		if($stmt->rowCount()>0){
			$getRow = $stmt->fetch(PDO::FETCH_ASSOC);
					if($getRow['sPass']==$pass)
					{
						
						if($getRow['banned']==1){
							myAlert("You have been blocked for not following rules.");
							header("refresh:0; url= index.html");
							exit();
						}
						
						myAlert("Login Successfully");
						$sEmail = $_POST['sEmail'];
						$stmt = $conn->query("SELECT sid FROM undolt.student where sEmail='$sEmail';");
						$row=$stmt->fetch(PDO::FETCH_ASSOC);
		
						session_start();

						$_SESSION['navSid'] = $row['sid'];
						header("refresh:0; url= studentDash.php");
						
					}
					else
					{
						myAlert("Password is incorrect");
						header("refresh:0; url= studentLogin.php");
					}
		}
		else{
		myAlert("User does not exists");
		header("refresh:0; url= studentLogin.php");
		}	
}
?>
<?php
function myAlert($msg){
	echo "<script>alert('$msg');</script>";
}

?>