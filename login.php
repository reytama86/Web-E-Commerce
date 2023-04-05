<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login Bakoel</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="bg">
		<form action="" method="post" class="box-login" >
		<h2>Login || ADMIN</h2>
		<input class="ph1" type="text" name="username" placeholder="Username">
		<input class="ph1" type="password" name="password" placeholder="Password">
		<input type="submit" name="submit" value="Login">
		<div class="balik">
			<a  href="index.php">balik ke tampilan awal</a>
		</div>
		</form>
	</div>		
	<?php
		if(isset($_POST['submit'])){
			session_start();
			include 'konek.php';
			$user = mysqli_real_escape_string($conn,$_POST['username']);
			$pass = mysqli_real_escape_string($conn,$_POST['password']);

			$cek = mysqli_query($conn, "SELECT * FROM tb_admin WHERE username ='".$user."' AND password = '".md5($pass)."'");
			if (mysqli_num_rows($cek) > 0){
				$d = mysqli_fetch_object($cek);
				$_SESSION['status_login']= true;
				$_SESSION['a_global'] = $d;
				$_SESSION['id'] = $d->admin_id;
				echo '<script>window.location="dashboard.php"</script>';
			}else{
				echo '<script>alert("Username atau password anda salah")</script>';
			}
		}
	?>
	</div>
</body>
</html>