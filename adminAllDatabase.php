<?php
	require_once 'connect.php';
	session_start();
	$aid = $_SESSION['navAid'];
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>All Database</title>
</head>
<body>

	<button onclick="location.href='adminDash.php';" style="margin-left: 92%;">To Dashboard</button>

	<h2>Managers</h2>

	 <div style="overflow-x: auto;">
	  <table class="center" border="2">
	  <col width="60">
	<col width="80">
	<col width="160">
	<col width="120">
	<col width="160">
	<col width="160">
	<col width="200">
	<tr>
		<th>S.N.</th>
		<th>Mid</th>
		<th>Name</th>
		<th>Contact</th>
		<th>Email</th>
		<th>Upi</th>
		<th>Account</th>
		
	</tr>
	<?php
	$i=1;
	$stmt = $conn->query("SELECT * FROM undolt.manager");
	while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
		$mid=$row['mid'];
		echo "<tr>";
		echo '<td>';
		echo $i;
		$i++;
		echo '</td>';
		echo '<td>';
		echo $row['mid'];
		echo '</td>';
		echo '<td>';
		echo $row['mName'];
		echo '</td>';
		echo '<td>';
		echo $row['mContact'];
		echo '</td>';
		echo '<td>';
		echo $row['mEmail'];
		echo '</td>';
		echo '<td>';
		echo $row['upi'];
		echo '</td>';
		echo '<td>';
		echo $row['bank']." - ".$row['ifsc']." - ".$row['bankName'];
		echo '</td>';
		echo "</tr>";
	}
	?>
</table>
</div>



<h2>Tutor</h2>

	 <div style="overflow-x: auto;">
	  <table class="center" border="2">
	  <col width="60">
	<col width="80">
	<col width="160">
	<col width="120">
	<col width="160">
	<col width="160">
	<col width="100">
	<col width="160">
	<col width="200">
	<tr>
		<th>S.N.</th>
		<th>Mid</th>
		<th>Name</th>
		<th>Contact</th>
		<th>Email</th>
		<th>Subjects</th>
		<th>Rating</th>
		<th>Upi</th>
		<th>Account</th>
		
	</tr>
	<?php
	$i=1;
	$stmt2 = $conn->query("SELECT * FROM undolt.tutor");
	while ($row2=$stmt2->fetch(PDO::FETCH_ASSOC)){
		$tid=$row2['tid'];
		echo "<tr>";
		echo '<td>';
		echo $i;
		$i++;
		echo '</td>';
		echo '<td>';
		echo $row2['tid'];
		echo '</td>';
		echo '<td>';
		echo $row2['tName'];
		echo '</td>';
		echo '<td>';
		echo $row2['tContact'];
		echo '</td>';
		echo '<td>';
		echo $row2['tEmail'];
		echo '</td>';
		echo '<td>';
		echo $row2['tsubject'];
		echo '</td>';
		echo '<td>';
		echo $row2['rating'];
		echo '</td>';
		echo '<td>';
		echo $row2['upi'];
		echo '</td>';
		echo '<td>';
		echo $row2['bank']." - ".$row2['ifsc']." - ".$row2['bankName'];
		echo '</td>';
		echo "</tr>";
	}
	?>
</table>
</div>



<h2>Students</h2>

	 <div style="overflow-x: auto;">
	  <table class="center" border="2">
	  <col width="60">
	<col width="80">
	<col width="160">
	<col width="120">
	<col width="160">
	<tr>
		<th>S.N.</th>
		<th>Sid</th>
		<th>Name</th>
		<th>Contact</th>
		<th>Email</th>
		
	</tr>
	<?php
	$i=1;
	$stmt3 = $conn->query("SELECT * FROM undolt.student;");
	while ($row3=$stmt3->fetch(PDO::FETCH_ASSOC)){
		$sid=$row3['sid'];
		echo "<tr>";
		echo '<td>';
		echo $i;
		$i++;
		echo '</td>';
		echo '<td>';
		echo $row3['sid'];
		echo '</td>';
		echo '<td>';
		echo $row3['sName'];
		echo '</td>';
		echo '<td>';
		echo $row3['sContact'];
		echo '</td>';
		echo '<td>';
		echo $row3['sEmail'];
		echo '</td>';
		echo "</tr>";
	}
	?>
</table>
</div>


<h2>Assignments</h2>

	 <div style="overflow-x: auto;">
	  <table class="center" border="2">
	  <col width="60">
	<col width="80">
	<col width="80">
	<col width="80">
	<col width="80">
	<col width="160">
	<col width="160">
	<col width="120">
	<col width="120">

	<tr>
		<th>S.N.</th>
		<th>Qid</th>
		<th>Sid</th>
		<th>Tid</th>
		<th>Mid</th>
		<th>Subject</th>
		<th>Status</th>
		<th>Student $</th>
		<th>Tutor $</th>
		
	</tr>
	<?php
	$i=1;
	$stmt4 = $conn->query("SELECT * FROM undolt.assignment;");
	while ($row4=$stmt4->fetch(PDO::FETCH_ASSOC)){
		echo "<tr>";
		echo '<td>';
		echo $i;
		$i++;
		echo '</td>';
		echo '<td>';
		echo $row4['qid'];
		echo '</td>';
		echo '<td>';
		echo $row4['sid'];
		echo '</td>';
		echo '<td>';
		echo $row4['assignTid'];
		echo '</td>';
		echo '<td>';
		echo $row4['approvedByMid'];
		echo '</td>';
		echo '<td>';
		echo $row4['subject'];
		echo '</td>';
		echo '<td>';
		echo $row4['aStatus'];
		echo '</td>';
		echo '<td>';
		echo $row4['price'];
		echo '</td>';
		echo '<td>';
		echo $row4['tPrice'];
		echo '</td>';
		echo "</tr>";
	}
	?>
</table>
</div>

</body>
</html>