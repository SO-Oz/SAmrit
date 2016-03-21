<?PHP

	// status enum
	
	$status = Array(
		'Uploading',			// [0]
		'Validating',			// [1]
		'Converting',			// [2]
		'Finalising',			// [3]
		'Downloading results',	// [4]
		'Error'					// [5]
		);
		
	
	$target_dir = 'tmp/';
	
	if(isset($_GET['s'])){
		$conversion_status = $_GET['s'];
	} else {
		$conversion_status = 'blank';
	}
	
	if(isset($_GET['name'])){
		$company_name = strtoupper(substr($_GET['name'], 0, 3));
	} else {
		$company_name = 'ABC';
	}
	
	if(isset($_POST['pressed'])){
		$conversion_status = 0;
	}
?>

<!DOCTYPE html>

<head>
	<title>ABC Auto-Template Alpha Demo</title>
	
	<style>
		body {
			background-color: #eeeeee;
			color: black;
			font-family: Arial, sans-serif;
		}
		
		.logo {
			color: #C80000;
			font-family: Tahoma, sans-serif;
			font-size: 120px;
			text-align: center;
			-webkit-text-stroke: 2px black;
		}
		
		#logo-div {
			height: 150px;
			width: 400px;
			border: solid 2px black;
			margin-top: 30px;
		}
		
		#file_name {
			width: 300px;
			margin-top: 40px;
			border: solid 1px black;
			background-color: #FFFFFF;
		}
		
		#submit {
			margin-top: 40px;
		}
		
		#file_upload {
			margin-top: 150px;
			border: double 4px #666666;
			width: 380px;
			padding: 10px 10px 10px 10px;
		}
		
		#status-text {
			margin-top: 150px;
		}
		
		#dl-menu {
			float: left;
			z-index: 99;
			text-align: left !important;
		}
		
		#dl-menu li {
			display: block;
		}
		
		.msg-text {
			float: left;
		}
		
		#debug{
			border: solid 1px black;
			margin-top: 40px;
			width: 300px;
			height: auto;
			background-color: black;
			color: white !important;
			font-family: 'Courier New', monospace;
		}
	</style>
	
</head>

<body>
<center>
	<div id="logo-div">
		<span class="logo"><strong><?PHP echo($company_name); ?></strong></span>
	</div>
	<br />
	<div id="dl-menu">
		<ul>
			<li><a href="#">PS Pay Changes</a></li>
			<li><a href="#">PS Timesheet</a></li>
			<li><a href="#">PS Basic Details</a></li>
			<li><a href="#">PS Employee Bank Details</a></li>
			<li><a href="#">PS Location Changes</a></li>
		</ul>
	</div>

	<div class="msg-text">
		<h3>Please upload your data in the standard ePayfact 2.0 template format for conversion to ePayfact 2.0 XML.</h3>
		<h3>Please see links on the left for templates</h3>
	</div>
	
	<?PHP
	
		if($conversion_status == 'blank'){
			?>
			<form id="file_upload" method="POST" action="abc-conversion-demo.php" enctype="multipart/form-data">
				<p>Please select a file to upload:</p>
				<input type="file" name="file_name" id="file_name" /><br />
				<input type="submit" value="Upload & Convert" id="submit" />
				<input type="hidden" name="pressed" value="1" />
			</form>
			<?PHP
		} else {
			?>
			<div id="status-text">
				<p><strong>
				
				<?PHP 
					if($conversion_status == 5){
						echo('There was an error uploading your file:<br /><br />' . urldecode($_GET['err']) . '</p><p>Please try again');
					} else {				
						echo('Your file is currently ' . $status[$conversion_status]);
					}
		}
				?>				
				</strong></p>
			</div>
			
			<!--DEBUG DIV REMOVE ONCE LIVE -->
			<div id="debug">
				<?PHP
					echo($conversion_status . '<br />' . $_GET['err']);
				?>
			</div>
			<!--DEBUG DIV REMOVE ONCE LIVE -->
			
			<?PHP
		
	
	// action each status
	
			switch($conversion_status){
				case 'blank':
					break;
				case 0:
					// upload
					$target_file = $target_dir . basename($_FILES['file_name']['name']);
					$file_ext = pathinfo($target_file, PATHINFO_EXTENSION);
						$conversion_status++;
						echo('<script>window.location.replace("http://www.themacroman.com/abc-conversion-demo.php?s=' . $conversion_status . '");</script>');					
					break;
				case 1:
					// validate
					$conversion_status++;
					echo('<script>window.location.replace("http://www.themacroman.com/abc-conversion-demo.php?s=' . $conversion_status . '");</script>');
					break;
				case 2:
					// convert
					$conversion_status++;
					echo('<script>window.location.replace("http://www.themacroman.com/abc-conversion-demo.php?s=' . $conversion_status . '");</script>');
					break;
				case 3:
					// finalise
					$conversion_status++;
					echo('<script>window.location.replace("http://www.themacroman.com/abc-conversion-demo.php?s=' . $conversion_status . '");</script>');
					break;
				case 4:
					// download
					echo('<script>window.location.replace("http://www.themacroman.com/abc-conversion-demo.php?s=' . $conversion_status . '");</script>');
					break;
				case 5:
					//error occured - message already displayed so just break
					break;
				default:
					echo('<script>window.location.replace("http://www.themacroman.com/abc-conversion-demo.php");</script>');
					break;
			}
		
	?>
</center>
</body>
</html>
