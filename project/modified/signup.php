<?php
$connection=mysqli_connect("localhost","root","iiits123","shoppingcart");
/*if($connection)
{
    echo "Record inserted";
}
else{
    echo "Error:".mysqli_error($connection);
}*/

$name= mysqli_real_escape_string($connection,$_POST['name']);
$uname= mysqli_real_escape_string($connection,$_POST['uname']);
$mail= mysqli_real_escape_string($connection,$_POST['email']);
$pwd= mysqli_real_escape_string($connection,$_POST['password']);
$type= mysqli_real_escape_string($connection,$_POST['type']);

$query="CREATE table farmer(name VARCHAR(20),username VARCHAR(20) NOT NULL,email VARCHAR(50),password VARCHAR(15));";

$query1="CREATE table customer(name VARCHAR(20),username VARCHAR(20) NOT NULL,email VARCHAR(50),password VARCHAR(15));";

if($type=="Farmer"){
	$query="INSERT INTO farmer VALUES('$name','$uname','$mail','$pwd');";
	echo '<script>
			alert("Account Created Successfully ");
			window.location="./AGlogin.html";
	</script>';
	if(mysqli_query($connection,$query))
	{
	 	echo "Inserted in farmer";
	}
	else{
		echo "Error:".mysqli_error($connection);
	}
	
}
else{
	$query="INSERT INTO customer VALUES('$name','$uname','$mail','$pwd');";
	
	if(mysqli_query($connection,$query))
	{
	 	echo '<script>
			alert("Account Created Successfully");
			window.location="./AGlogin.html";
		</script>';
	}
	else{
		echo "Error:".mysqli_error($connection);
	}
}
//$query="drop table signup;";
/*if(mysqli_query($connection,$query1))
{
	 echo "Created";
}
else{
	echo "Error:".mysqli_error($connection);
}*/

?>



