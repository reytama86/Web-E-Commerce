<?php
    include 'konek.php';
    $kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_address FROM tb_admin WHERE admin_id = 1");
    $a = mysqli_fetch_object($kontak);
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
    <style>

    </style>
</head>
<body>
    <!-- Headernya-->
    <header>
    <div class="container">
    <h1><a href="MenuT.php"> BAKOEL BOEKOE</a></h1>
        <ul>
            <li><a href="produk.php"> Produk </a></li>
        </ul>
    </div>
    </header>

    <!-- search -->
    <div class="search">
        <div class="container">
            <form action="produk.php">
                <input type="text" name="search" placeholder="Cari Produk">
                <input type="submit" name="cari" value="Cari Produk">
            </form><br><br>
            <div class="content-slide">
                <div class="imgslide fade">
                    <div class="numberslide">1 / 3</div>
                    <img src="img/1111.jpg" alt="">
                </div>
                <div class="imgslide fade">
                    <div class="numberslide">2 / 3</div>
                    <img src="img/2a.png" alt="">
                </div>
                <div class="imgslide fade">
                    <div class="numberslide">3 / 3</div>
                    <img src="img/3b.png" alt="">
                </div>
                <a class="prev" onClick="nextslide(-1)">&#10094;</a>
                <a class="next" onClick="nextslide(1)">&#10095;</a> 
            </div><br>
            <div class="page">
                <span class="dot" onClick="dotslide(1)"></span>
                <span class="dot" onClick="dotslide(2)"></span>
                <span class="dot" onClick="dotslide(3)"></span>
            </div>
        </div>
    </div>
    <!--- category --->
    <div class="section">
        <div class="container">
            <h3> Kategori </h3>
            <div class="box">
                <?php
                    $kategori = mysqli_query($conn, "SELECT * FROM tb_category ORDER BY
                        category_id DESC");
                    if(mysqli_num_rows($kategori) > 0){
                        while($k = mysqli_fetch_array($kategori)){
                ?>  
                    <a href="produk.php?kat=<?php echo $k['category_id'] ?>">
                        <div class="col-5">
                            <img src="produk/kategori1.png" width="70px" style="margin-bottom":5px;>
                            <p><?php echo $k['category_name'] ?></p>
                        </div>
                <?php }}else{ ?>
                    <p>Kategori tidak ada</p> 
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- new product-->
    <div class="section">
        <div class="container">
            <h3>Produk Terlaris</h3>
            <div class="box">
                <?php
                    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 ORDER BY product_id DESC LIMIT 8");
                    if(mysqli_num_rows($produk) > 0){
                        while($p = mysqli_fetch_array($produk)){
                ?>
                    <a href="detail-produk.php?id=<?php echo $p['product_id'] ?>">
                        <div class="col-4">
                            <img src="produk/<?php echo $p['product_image'] ?>" width="120px">
                            <p class="nama"><?php echo substr($p['product_name'], 0, 30)  ?></p>
                            <p class="harga">Rp. <?php echo number_format($p['product_price'])  ?></p>
                        </div>
                    </a>
                <?php }}else{ ?>
                    <p>Produk Tidak Ada</p>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- footer -->
    <div class="footer">
        <div class="container">
            <h4>Alamat</h4>
            <p><?php echo $a->admin_address ?></p>

            <h4>Email</h4>
            <p><?php echo $a->admin_email ?></p>

            <h4>No. Hp</h4>
            <p><?php echo $a->admin_telp ?></p>
            <small>Copyright &copy; 2022 - <span>Bakoel Boekoe.</small>
        </div>
    </div>
    <script>
        var slideIndex = 1;
            showSlide(slideIndex);
        function nextslide(n){
            showSlide(slideIndex += n);
        }
        function dotslide(n){
            showSlide(slideIndex = n);
        }
        function showSlide(n) {
            var i;
            var slides = document.getElementsByClassName("imgslide");
            var dot = document.getElementsByClassName("dot");  
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length;
            }
            for (i = 0; i < slides.length; i++) {     
                slides[i].style.display = "none";
            }
            for (i = 0; i < slides.length; i++) {      
                dot[i].className = dot[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dot[slideIndex - 1].className += " active";
        }
    </script>
</body>
</html>