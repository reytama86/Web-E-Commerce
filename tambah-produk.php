<?php
	session_start();
    include 'konek.php';
	if($_SESSION['status_login'] != true){
		echo'<script>window.location="login.php"</script>';
	}
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
    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
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
            <h3>Tambah Data Produk</h3>
            <div class="box">
               <form action="" method="POST" enctype="multipart/form-data">
                   <select class="input-control" name="kategori" require>
                       <option value="">---Pilih---</option>
                       <?php
                            $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY category_id DESC");
                            while($r = mysqli_fetch_array($kategori)){
                       ?>
                        <option value="<?php echo $r['category_id'] ?>"><?php echo $r['category_name'] ?></option>
                       <?php } ?>
                   </select>
                   <input type="text" name="nama" class="input-control" placeholder="Nama Produk" require>
                   <input type="text" name="harga" class="input-control" placeholder="Harga" require>
                   <input type="file" name="gambar" class="input-control"  require>
                   <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"></textarea>
                   <select class="input-control" name="status">
                       <option value="">---Pilih Status----</option>
                       <option value="1">AKTIF</option>
                       <option value="0">TIDAK AKTIF</option>
                   </select>
                    <input type="submit" name="submit" value="Submit" class="btn">
               </form>
               <?php
                  if(isset($_POST['submit'])){

                        //print_r($_FILES['gambar']); 
                        //menampung inputan dari form
                        $kategori   = $_POST['kategori'];
                        $nama       = $_POST['nama'];
                        $harga      = $_POST['harga'];
                        $deskripsi  = $_POST['deskripsi'];
                        $status     = $_POST['status'];
                        
                        //menampung data file yang di upload 
                        $filename   = $_FILES['gambar']['name'];
                        $tmp_name   = $_FILES['gambar']['tmp_name'];

                        $type1 = explode('.', $filename);
                        $type2 = $type1[1];

                        $newname = 'produk'.time().'.'.$type2;

                        //menampung data format file yang diijinkan
                        $tipe_diizinkan = array('jpg', 'jpeg', 'png');

                        //validasi format file
                        if(!in_array($type2, $tipe_diizinkan)){
                        //iki nek format file e gak cocok mbek seng ndek dukur
                          echo '<script>alert("Format file yang anda Upload Tidak diijinkan")</script>';  
                        }else{
                        
                        //jika format file sudah oke
                        //proses upload file + insert ke database
                           move_uploaded_file($tmp_name, './produk/'.$newname);

                           $insert = mysqli_query($conn, "INSERT INTO tb_product VALUES (
                                             null,
                                             '".$kategori."',
                                             '".$nama."',
                                             '".$harga."',
                                             '".$deskripsi."',
                                             '".$newname."',
                                             '".$status."',
                                             null
                                                 ) ");
                            if($insert){
                                echo '<script>alert("Simpan data Berhasil")</script>';
                                echo '<script>window.location="data-produk.php"</script>';
                            }else{
                                echo 'Gagal'.mysqli_error($conn);
                            }
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
    <script>
        CKEDITOR.replace( 'deskripsi' );
    </script>
</body>
</html>