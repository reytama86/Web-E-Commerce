<?php
	session_start();
    include 'konek.php';
	if($_SESSION['status_login'] != true){
		echo'<script>window.location="login.php"</script>';
	}
    $kategori = mysqli_query($conn, "SELECT * FROM tb_category WHERE category_id = '".$_GET['id']."' ");
    if(mysqli_num_rows($kategori) == 0){
        echo '<script>window.location="data-kategori.php"</script>';
    }
    $k = mysqli_fetch_object($kategori);
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
    <h1><a href="dashboad.php"> BAKOEL BOEKOE</a></h1>
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
            <h3>Edit Data Kategori</h3>
            <div class="box">
               <form action="" method="POST">
                    <input type="text" name="nama" placeholder="Nama Kategori" class="input-control" value="<?php echo $k->category_name?>"  required>
                    <input type="submit" name="submit" value="Submit" class="btn">
               </form>
               <?php
                  if(isset($_POST['submit'])){

                    $nama = ucwords($_POST['nama']);

                    $update = mysqli_query($conn, "UPDATE tb_category SET 
                                            category_name = '".$nama."' 
                                            WHERE category_id = '".$k->category_id."' ");
                    
                    if($update){
                        echo '<script>alert("Edit data Berhasil")</script>';
                        echo '<script>window.location="data-kategori.php"</script>';
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
            <small>Copyright &copy;2022 - WARUNG KITA</small>
        </div>
    </footer>
</body>
</html>