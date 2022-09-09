<?php
	require_once 'connect.php';
	session_start();
		$aid = $_SESSION['navAid'];
		

	if (isset($_POST['assignSubmit'])) {
		$qid = $_POST['qid'];
		$adrs = $_POST['header'];

		$stmt = $conn->query("SELECT * FROM undolt.assignment where qid = $qid;");
			$row=$stmt->fetch(PDO::FETCH_ASSOC);

			$tid=$row['assignTid'];
			$dir='solutions/T'.$tid."/";

			$i=1;
				$name='sol'.$i;
				while ($row[$name]) {
					if( !unlink($dir.$row[$name]) ){
						myAlert("file$i Not deleted from Database");
					}else{
						 myAlert("file$i deleted from Database");
					}
					$i++;
					$name='sol'.$i;
					if($i==6) break;
				}

		$sql6 = "update undolt.assignment set aStatus = 'Approved' where qid = $qid;";
		$sql8 = "update undolt.assignment set assignTid ='-999' where qid = $qid;";
		$sql9 = "update undolt.assignment set sol1 = '' where qid = $qid;";
		$sql10 = "update undolt.assignment set sol2 = '' where qid = $qid;";
		$sql11 = "update undolt.assignment set sol3 = '' where qid = $qid;";
		$sql12 = "update undolt.assignment set sol4 = '' where qid = $qid;";
		$sql13 = "update undolt.assignment set sol5 = '' where qid = $qid;";
		$sql14 = "update undolt.assignment set solInfo = '' where qid = $qid;";

		$stmt6 = $conn->prepare($sql6);
		$stmt8 = $conn->prepare($sql8);
		$stmt9 = $conn->prepare($sql9);
		$stmt10 = $conn->prepare($sql10);
		$stmt11 = $conn->prepare($sql11);
		$stmt12 = $conn->prepare($sql12);
		$stmt13 = $conn->prepare($sql13);
		$stmt14 = $conn->prepare($sql14);
		
		try{
			$stmt6->execute();
			$stmt8->execute();
			$stmt9->execute();
			$stmt10->execute();
			$stmt11->execute();
			$stmt12->execute();
			$stmt13->execute();
			$stmt14->execute();

		}catch(PDOException $e){
			myAlert("Internal Error");
			header("refresh:0; url= $adrs");
		}

		myAlert("Tutor Unassigned Successfully Updated");
		header("refresh:0; url= $adrs");
    	exit();
		

	}

	if(isset($_POST['assignDelete'])){
		$qid = $_POST['qid'];
		$adrs = $_POST['header'];

		$stmt = $conn->query("SELECT * FROM undolt.assignment where qid = $qid;");
		$row=$stmt->fetch(PDO::FETCH_ASSOC);

		$sid=$row['sid'];
		$fdir='uploads/'.$sid."/";

		$tid=$row['assignTid'];
		$sdir='solutions/T'.$tid."/";	

		$sql12 = "update undolt.sreferral set used_ref =used_ref-1 where sid = $sid;";
		$sql13 = "update undolt.sreferral set applicable_ref =applicable_ref+1 where sid = $sid;";

		$stmt12 = $conn->prepare($sql12);
		$stmt13 = $conn->prepare($sql13);

		if(($row['aStatus']!='Completed' && $row['aStatus']!='Reviewed') && $row['ref_used']==1 ){
			$stmt12->execute();
			$stmt13->execute();
		}

		$stmt2 = $conn->prepare("DELETE FROM undolt.assignment where qid=:q;");
		$stmt2->bindParam(':q',$qid);
		$stmt2->execute();

		if(!$stmt2->rowCount()){
			myAlert("Some Internal Error Occured");
			header("refresh:0; url= $adrs");
			exit();
			}else{
				$i=1;
				$name='file'.$i;
				while ($row[$name]) {
					if( !unlink($fdir.$row[$name]) ){
						myAlert("file$i Not deleted from Database");
					}else{
						 myAlert("file$i deleted from Database");
					}
					$i++;
					$name='file'.$i;
					if($i==5) break;
			}

			$i=1;
				$name='sol'.$i;
				while ($row[$name]) {
					if( !unlink($sdir.$row[$name]) ){
						myAlert("file$i Not deleted from Database");
					}else{
						 myAlert("file$i deleted from Database");
					}
					$i++;
					$name='sol'.$i;
					if($i==6) break;
				}

			myAlert("Assignment Deleted Successfully");
			header("refresh:0; url= $adrs");
			exit();
		}
	}

	if (isset($_POST['assignApprove'])) {
		$qid = $_POST['qid'];
		$adrs = $_POST['header'];

		$sql15 = "update undolt.assignment set aStatus = 'Completed' where qid = $qid;";
		$stmt15 = $conn->prepare($sql15);
		try{
			$stmt15->execute();

		}catch(PDOException $e){
			myAlert("Internal Error");
			header("refresh:0; url= $adrs");
		}
		myAlert("Solution Approved");
		header("refresh:0; url= $adrs");
	}

	if (isset($_POST['assignImprove'])) {
		$qid = $_POST['qid'];
		$adrs = $_POST['header'];
		$stmt = $conn->query("SELECT * FROM undolt.assignment where qid = $qid;");
			$row=$stmt->fetch(PDO::FETCH_ASSOC);

			$tid=$row['assignTid'];
			$dir='solutions/T'.$tid."/";

			$i=1;
				$name='sol'.$i;
				while ($row[$name]) {
					if( !unlink($dir.$row[$name]) ){
						myAlert("file$i Not deleted from Database");
					}else{
						 myAlert("file$i deleted from Database");
					}
					$i++;
					$name='sol'.$i;
					if($i==6) break;
				}

		$sql6 = "update undolt.assignment set aStatus = 'Accepted by Tutor' where qid = $qid;";
		$sql9 = "update undolt.assignment set sol1 = '' where qid = $qid;";
		$sql10 = "update undolt.assignment set sol2 = '' where qid = $qid;";
		$sql11 = "update undolt.assignment set sol3 = '' where qid = $qid;";
		$sql12 = "update undolt.assignment set sol4 = '' where qid = $qid;";
		$sql13 = "update undolt.assignment set sol5 = '' where qid = $qid;";
		$sql14 = "update undolt.assignment set solInfo = '' where qid = $qid;";

		$stmt6 = $conn->prepare($sql6);
		$stmt9 = $conn->prepare($sql9);
		$stmt10 = $conn->prepare($sql10);
		$stmt11 = $conn->prepare($sql11);
		$stmt12 = $conn->prepare($sql12);
		$stmt13 = $conn->prepare($sql13);
		$stmt14 = $conn->prepare($sql14);
		
		try{
			$stmt6->execute();
			$stmt9->execute();
			$stmt10->execute();
			$stmt11->execute();
			$stmt12->execute();
			$stmt13->execute();
			$stmt14->execute();

		}catch(PDOException $e){
			myAlert("Internal Error");
			header("refresh:0; url= $adrs");
			exit();
		}

		myAlert("Solution gone for improvment");
		header("refresh:0; url= $adrs");
    	exit();
		
	}
	if (isset($_POST['removeStudent'])) {
		$sid = $_POST['sid'];
		$sql15 = "update undolt.student set banned = 1 where sid = $sid;";
		$stmt15 = $conn->prepare($sql15);

		try{
			$stmt15->execute();

		}catch(PDOException $e){
			myAlert("Internal Error");
			header("refresh:0; url= adminSearchOthers.php");
			exit();
		}

		myAlert("Student blocked Successfully");
		header("refresh:0; url= adminSearchOthers.php");
    	exit();

	}
	if (isset($_POST['removeTutor'])) {
		$tid = $_POST['tid'];
		$sql16 = "update undolt.Tutor set banned = 1 where tid = $tid;";
		$stmt16 = $conn->prepare($sql16);

		try{
			$stmt16->execute();

		}catch(PDOException $e){
			myAlert("Internal Error");
			header("refresh:0; url= adminSearchOthers.php");
			exit();
		}

		myAlert("Tutor blocked Successfully");
		header("refresh:0; url= adminSearchOthers.php");
    	exit();

	}
	if (isset($_POST['removeManager'])) {
		$mid = $_POST['mid'];
		$sql17 = "update undolt.manager set banned = 1 where mid = $mid;";
		$stmt17 = $conn->prepare($sql17);

		try{
			$stmt17->execute();

		}catch(PDOException $e){
			myAlert("Internal Error");
			header("refresh:2; url= adminSearchOthers.php");
			exit();
		}

		myAlert("Manager blocked Successfully");
		header("refresh:0; url= adminSearchOthers.php");
    	exit();

	}

?>

<?php
function myAlert($msg){
	echo "<script>alert('$msg');</script>";
}

?>