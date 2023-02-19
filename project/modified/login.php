<?php
$connection=mysqli_connect("localhost","root","iiits123","shoppingcart");
/*
if($connection)
{
    echo "Record inserted";
}
else{
    echo "Error:".mysqli_error($connection);
}*/

//session_start();
$uname=$_POST['uname'];
$password=$_POST['pwd'];
$type=$_POST['type'];
if($type=="Farmer"){
	$check=mysqli_query($connection,"SELECT * from farmer WHERE username='$uname' AND password='$password';");
	if(mysqli_num_rows($check))
	{
		echo '<script>
			window.location="./Agriwave/farmer-interface.html";
		</script>';
	}
	else{
		//echo "Error:".mysqli_error($connection);
		echo '<script>
			alert("invalid credentials!");
			window.location="./AGlogin.html";
		</script>';
	}
}
else{
	$check1=mysqli_query($connection,"SELECT * from customer WHERE username='$uname' AND password='$password';");
	if(mysqli_num_rows($check1))
	{
		echo '<script>
			alert("details mattched");
			window.location="./customer";
		</script>';
	}
	else{
		echo '<script>
			alert("invalid credentials!");
			window.location="./AGlogin.html";
		</script>';
	}
}




?>
