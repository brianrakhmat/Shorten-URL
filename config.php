    <?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $db = "shorten";
    mysql_connect($host,$user,$pass);
    mysql_select_db($db);
    $site['root']   = "http://localhost/shorten-url/"; 
    ?>