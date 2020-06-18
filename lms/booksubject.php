<?php include 'includes/header.php'; 

	if(!isset($_SESSION['id'])) { // goes back to public home page if not signed in
		die(header("Location: index.php"));
	}
	
	include 'includes/dbcon.php'; //$db_conn

	$qry = "SELECT * FROM booksubject Order by Subject_ID ASC";
	$result = $db_conn->query($qry);

?>

<head>
	<title>Book Subject</title>
</head>
<body>
<div id="main">
<div id="main-content">
	<!-- Breadcrumb -->
	<p><a href="home.php">Home</a> > Book Subject Table</p> 
	<h2 id="padding">Book Subject Table</h2>

	<form id="form" name="frmUser" method="post">
	<table id="table" style="margin-left: 5%;">
	<tr> 
	<!-- table headings -->
		<th>Subject ID</th>
		<th>Book Number</th>
		
		
	</tr>
	<!-- While loop to fetch data from table -->
	<?php
		$i=0;
		while($row = mysqli_fetch_array($result)) {
		
		if($i%2==0)
			$classname="evenRow";
		else
			$classname="oddRow";
		?>
		<tr class="<?php if(isset($classname)) echo $classname;?>">
			<td><?php echo $row['Subject_ID']; ?></td>
			<td><?php echo $row['Bk_Num']; ?></td>
		</tr>
	<?php
		$i++;
	}
	$account = $_SESSION['account']; //show only if admin user
	if($account == "admin") { ?>
	
		<tr class="lastrow">
				<td colspan="10">
					<button onClick="edit();" />Edit Mode</button>
				</td>
		</tr>
	<?php 
	} 
	?>
	</table>
	</form>
	<br/>
	<br/>
	<br/>
	<br/><br/>
</div>
</div>


<?php include "includes/footer.php"; ?>

<script>

function edit() {

    document.frmUser.action = "editbooksubject.php";
    document.frmUser.submit();
}


</script>