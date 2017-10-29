<html>
<head>
	<title>PDO | Database Result</title>
	
  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.6/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"></script>
</head>
<body>

	<?php

	class MyDatabase {


		public function __construct() {
		}

		//Function to connect database
		public function getConnection() {
			$user = 'ccp22';
			$pass = 'BxTEeds4U';
			try{
				$con = new PDO('mysql:host=sql1.njit.edu;dbname=ccp22',$user,$pass);
				echo "<h4>Connected Successfully!</h4><br>";
				return $con;
			}catch(PDOException $exception) {
				echo "<h1>Error has been occured!: ".$exception->getMessage()."</h1><br>";
			}
		}
		
		//Function to fetch results
		public function fetchData($db) {
			
			$query = "SELECT id,fname,lname,email,phone,birthday FROM accounts WHERE id < 6";
			$result = $db->prepare($query);
			$result->execute();
			$total = $result->rowCount();
			echo "<h1>Total rows in the result: ".$total."</h1><br>";
			echo "<table class=\"table table-hover\">";
			if($total > 0) {
				echo "<thead class=\"thead-dark\"><tr><th>User ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Birthday</th></tr></thead>";
				echo "<tbody>";
				foreach($result as $row) {
					echo "<tr><th scope=\"row\">".$row['id']."</th><td>".$row['fname']."</td><td>".$row['lname']."</td><td>".$row['email']."</td><td>".$row['phone']."</td><td>".$row['birthday']."</td></tr>";
				}
			}
			echo "</tbody></table>";
		}
	}
	?>
	
	<?php
	if(isset($_POST['submit'])) {
		$object = new MyDatabase();
		$con = $object->getConnection();
		$object->fetchData($con);

	}else {

		echo "<div class=\"container\">";
			echo "<h1></h1>";
			echo "<div class=\"row\">";
				echo "<div class=\"col-sm-1\"></div>";
				echo "<div class=\"col-sm-10\">";
					echo "<form class=\"form-horizontal\" action=\"\" method=\"post\" enctype=\"multipart/form-data\">";
						echo "<div class=\"form-group\">";
							echo "<h1>Press Connect to fetch all users with ID less than 6.</h1>";
						echo "</div>";
						echo "<div class=\"form-group\">";        
							echo "<div class=\"col-sm-offset-2 col-sm-10\">";
								echo "<button class=\"btn btn-secondary\" type=\"submit\" name=\"submit\">Connect!</button>";
							echo "</div>";
						echo "</div>";
					echo "</form>";
				echo "</div>";
				echo "<div class=\"col-sm-2\"></div>";
			echo "</div>";
		echo "</div>";
	}
	?>
	

</body>
</html>




