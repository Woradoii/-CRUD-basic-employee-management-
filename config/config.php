
<?php
    // host , username , passsword , database name
    $connect= mysqli_connect('localhost','root','','company');

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
    