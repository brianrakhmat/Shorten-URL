<html>
<head>
      <title>Shorten URL | Brianrakhmataji.com</title>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="assets/css/materialize.min.css"  media="screen,projection"/>

      <!--Let browser know website is optimized for mobile-->
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

      <!--Import jQuery before materialize.js-->
      <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
      <script type="text/javascript" src="assets/js/materialize.min.js"></script>
      <link type="text/css" rel="stylesheet" href="assets/css/materialize.css">
</head>
<body>
  <nav>
    <div class="container">
    <div class="nav-wrapper">
      <a href="index.php" class="brand-logo">Shorten URL System</a>
    </div>
    </div>
  </nav>
<?php
  ob_start();

  // Memanggil file config.php
  include("config.php");
  
  // Mengambil url pendek pada address bar
  $url = mysql_real_escape_string($_GET['url']);

  // Mengambil data dari database "url" yang sesuai dengan variabel $url
  $sql_url  = mysql_query("select * from url where url_pendek = '$url'");

  // Menampilkan hasil $sql_url menjadi array berbentuk object
  $url_row  = mysql_fetch_object($sql_url);

  // Menampilkan hasil $sql_url menjadi angkan atau menghitung semua data yang ada pada tabel "url"
  $cek = mysql_num_rows($sql_url);

  // Jika url pendek ada pada tabel url
  if($cek > 0){
    // Menambah 1 point pada field hit
    mysql_query("update url set hit = '$url_row->hit'+1 where id = '$url_row->id'");

    // Mengalihkan ke url asli dari url pendek
    header("location: $url_row->url_asli");

  // Jika url pendek tidak terdapat pada tabel url
  }else{
    echo "
      <div class='container'>
        <h1>404 Not Found</h1>
        <h5>Oops! Kami tidak menemukan alamat yang anda tuju.<br>
        Silakan cek kembali URL anda atau kembali ke homepage www.domainkamu.com
        </h5><br><br>
        <center><a href='index.php' class='waves-effect waves-light btn'><i class='material-icons left'>closed</i>Go Back</a></center>
      </div>";
  }
?>
</body>
</html>