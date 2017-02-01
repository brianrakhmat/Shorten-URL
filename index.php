<?php
include("config.php");
function acak($panjang)
{
    $karakter= '123456789abcdefghjkmnpqrstuvwxyz';
    $string = '';
    for ($i = 0; $i < $panjang; $i++) {
    $pos = rand(0, strlen($karakter)-1);
    $string .= $karakter{$pos};
    }
    return $string;
}
?>
<!DOCTYPE HTML>
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
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>

      <ul class="right hide-on-med-and-down">
        <li><a href="index.php">Home</a></li>
      </ul>
    </div>
    </div>
  </nav>

    <div class="container">
    <br><br>
    <h1>Shorten URL System</h1><br>
      <div class="row">

        <div class="col s12">
          <?php
          // jika tombol dengan nama shorten ditekan ...
          if($_POST['shorten']) {
          
          // Membuat variabel $url_asli
          $url_asli = mysql_real_escape_string($_POST['url']);

          // Membuat variabel $url_pendek
          $url_pendek = acak(2).substr(uniqid(), 1, 1); // (Kombinasinya bisa bermacam-macam)


          // Jika variabel $url_asli kosong
          if(!$url_asli) {
            echo "Masukan url kamu. <a href='index.php'>Kembali</a>";

          // Sebaliknya
          }else{
            // Jika berhasil menginput data ke database
            if(mysql_query("insert into url values(NULL, '$url_asli', '$url_pendek', '0', NOW())")) {
        ?>
    <div class="input-field inline">
      <div class="row">
        <div class="col s12 m12">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title"><b>BERHASIL!</b></span>
              <p>Silakan copy URL dibawah ini.</p>
            </div>
          </div>
        </div>
      </div>
            <input id="foo" type="text" value="<?php echo $site['root'].$url_pendek; ?>" class="validate" onclick="this.select()">
              <!--Membuat tombol copy-->
              <button class="btn" data-clipboard-action="copy" data-clipboard-target="#foo">Copy</button>
              <script src="clipboard/dist/clipboard.min.js"></script>
                <script>
                var clipboard = new Clipboard('.btn');

                clipboard.on('success', function(e) {
                  console.log(e);
                });

                clipboard.on('error', function(e) {
                  console.log(e);
                });
              </script>

            <button type="submit" class="waves-effect waves-light btn" value="Tutup" onclick="document.location='<?php echo $site['root']; ?>'"><i class="material-icons left">closed</i>Tutup Gan</button>
    </div>
          
        </div>
        <?php
            // Jika gagal
            }else{
              echo "Gagal Memperpendek URL !! (".mysql_error().")";
            }
          }
        }else{
        ?>      
    <form method="post" class="col s12">
      <div class="row">
        <div class="col s12">
          <div class="input-field inline">
            <input  type="text" name="url" class="validate">
            <label  data-error="wrong" data-success="right">Long URL</label>
            <button type="submit" name="shorten" class="waves-effect waves-light btn" value="Shorten!"><i class="material-icons right">send</i>Shorten Gan </button>
          </div>
        </div>
      </div>
    </form>
    <?php } ?>
  </div>
    </div>
  </body>
</html>