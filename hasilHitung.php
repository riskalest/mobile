<?php 
    include "koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Perhitungan Penjualan "Toko Dinar"</title>
  <link rel="shortcut icon" href="assets/dist/img/icon.png" type="image/x-icon" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/ionicons.min.css">
  <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
</head>

<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <a href="index.php" class="logo">
      <span class="logo-mini"><b>A</b>PS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Aplikasi</b>PPAM</span>
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

    </nav>
  </header>
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="assets/dist/img/icon.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>PPAM</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Mobile</a>
        </div>
      </div>

      <ul class="sidebar-menu">
        <li class="header">MENU</li>
         <li class="treeview">
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Beranda</span>
            <span class="pull-right-container">
            </span>
          </a>
        <a href="tabelProduk.php">
			<i class="fa fa-dashboard"></i> <span>Daftar Produk</span> <br/>			
            <span class="pull-right-container">
            </span>
        </a>   		  
		<a href="input.php">
			<i class="fa fa-dashboard"></i> <span>Transaksi</span> <br/>			
            <span class="pull-right-container">
            </span>
        </a> 
        </li>
    </section>
  </aside>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Perhitungan Penjualan "Toko Dinar"
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Selamat datang</li>
      </ol>
    </section>


    <section class="content">
		<?php 
		error_reporting(0);
		$nama_produk = $_POST['nama_produk'];
		$harga_produk = $_POST['harga_produk'];
		$jumlah_barang = $_POST['jumlah_barang'];
		$diskon_barang = $_POST['diskon_barang'];
		$tanggal = $_POST["Y-m-d H:i:s"];

		$sql = $kon->query("insert into perhitungan (jumlah_barang,diskon_barang,tanggal) 
				values ($jumlah_barang,'$diskon_barang',$tanggal)");
		/*========= Fungsi Menghitung subtotal =========*/
		$subtotal = $harga_produk * $jumlah_barang ;


		/*========= Menghitung barang berdasarkan diskon ( atau bukan pelanggan). =========*/
		// Keterangan:
		// Jika barang diskon maka akan mendapat potongan harga sebanyak 10%.
		// Jika barang tidak diskon maka tidak mendapat potongan harga. 
		/////////////////////////////////////////////////////////////////////////////////////
		switch ($diskon_barang){
		 case "2%": 
		  $diskon = $subtotal * 0.02;
		 break; 		  
		 case "4%": 
		  $diskon = $subtotal * 0.04;
		 break; 
		 case "5%": 
		  $diskon = $subtotal * 0.05;
		  break;
		 case "7%": 
		  $diskon = $subtotal * 0.07;
		break;
		 case "10%": 
		  $diskon = $subtotal * 0.1;
		 break; 
		 default: 
		  $diskon = 0; 
		 }


		/*========= Fungsi Menghitung total keseluruhan =========*/
		$total = $subtotal - $diskon;
		?>	
      <div class="row">
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-primary">
	            <div class="box-header with-border">
	              
	            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-striped">
                <tr>
                  <td>Nama Barang</td>
                  <td><span class="badge bg-red"><?php echo "$nama_produk"; ?></span></td>
                </tr>
                <tr>
                  <td>Harga Barang</td>
                  <td><span class="badge bg-light-blue"><?php echo "Rp. ".number_format($harga_produk); ?></span></td>
                </tr>
                <tr>
                  <td>Jumlah Barang</td>
                  <td><span class="badge bg-red"><?php echo "$jumlah_barang"; ?></span></td>
                </tr>
                <tr>
                  <td>Subtotal</td>
                  <td><span class="badge bg-light-blue"><?php echo "Rp. ".number_format($subtotal); ?></span></td>
                </tr>
                <tr>
                  <td>Diskon Barang</td>
                  <td><span class="badge bg-red"><?php echo "$diskon_barang"; ?></span></td>
                </tr>
                <tr>
                  <td>Jumlah Diskon</td>
                  <td><span class="badge bg-light-blue"><?php echo "Rp. ".number_format($diskon); ?></span></td>
                </tr>
                <tr>
                  <td>Total</td>
                  <td><span class="badge bg-red"><?php echo "Rp. ".number_format($total); ?></span></td>
                </tr>                                
              </table>
            </div>
	          <div class="form-group">
						<button class="btn btn-primary" onclick="myFunction()">Cetak</button>
							<script>
							function myFunction() {
								window.print();
							}
							</script>
	          </div>			
            <!-- /.box-body -->
          </div>
        </div>
      </div>
    </section>
  </div>

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Kelompok :</b> Ummah, April, Riska
    </div>
    Copyright &copy; 2018 <a href="https://drive.google.com/drive/folders/1N9rYyzJdSttKNzSzBzxOl9_rWOF8Ax-F?ogsrc=32/" target="_blank" title="Link Penjualan"><strong>PPAM</strong></a>
  </footer>


<script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/plugins/fastclick/fastclick.js"></script>
<script src="assets/dist/js/app.min.js"></script>
<script src="assets/dist/js/demo.js"></script>
</body>
</html>