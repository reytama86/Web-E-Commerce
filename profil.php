<?php
	session_start();
    include 'konek.php';
	if($_SESSION['status_login'] != true){
		echo'<script>window.location="login.php"</script>';
	}

    $query = mysqli_query($conn,"SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['id']."' ");
    $d= mysqli_fetch_object($query);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BAKOEL BOEKOE</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&family=Raleway:ital,wght@0,200;1,500;1,700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Headernya-->
    <header>
    <div class="container">
    <h1><a href="dashboad.php">&#8226 <span>B</span>akoel <span>B</span>oekoe</a></h1>
        <ul>
            <li><a href="dashboard.php"> Dashboard </a></li>
            <li><a href="profil.php"> Profile </a></li>
            <li><a href="data-kategori.php"> Data Kategori </a></li>
            <li><a href="data-produk.php"> Data Produk  </a></li>
            <li><a href="keluar.php"> Logout </a></li>
        </ul>
        </div>
    </header>

    <!-- Kontennya ya dek-->
    <div class="section">
        <div class="container">
            <h3>Profil</h3>
            <div class="box">
               <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama lengkap" class="input-control" value="<?php echo $d->admin_name ?>" required>
                    <input type="text" name="user" placeholder="User name" class="input-control" value="<?php echo $d->username ?>" required>
                    <input type="text" name="hp" placeholder="No HP" class="input-control" value="<?php echo $d->admin_telp ?>" required>
                    <input type="email" name="email" placeholder="Email" class="input-control" value="<?php echo $d->admin_email ?>" required>
                    <input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo $d->admin_address ?>" required>
                    <input type="submit" name="submit" value="Ubah Data" class="btn">
               </form>
               <?php
                   if(isset($_POST['submit'])){

                      $nama     = $_POST['nama'];
                      $user     = $_POST['user']; 
                      $hp       = $_POST['hp'];  
                      $email    = $_POST['email'];
                      $alamat   = $_POST['alamat'];

                      $update = mysqli_query($conn, "UPDATE tb_admin SET
                      admin_name = '".$nama."',
                      username = '".$user."',
                      admin_telp = '".$hp."',
                      admin_email = '".$email."',
                      admin_address = '".$alamat."'
                      WHERE admin_id = '".$d->admin_id."' ");
                        if($update){
                            echo '<script>alert("Ubah data berhasil")</script>';
                            echo '<script>window.location="profil.php")</script>';
                        }else{
                            echo 'gagal'.mysqli_error($conn);
                        }
                   }
               ?>
            </div>
        </div>
    </div>
    <!--Footer-->
    <footer>
        <div class="container">
            <small>Copyright &copy;2022 - BAKOEL BOEKOE</small>
        </div>
    </footer>
</body>
</html>