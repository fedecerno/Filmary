<?php
include "../inc/dbinfo.inc";

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();

$id_user = $_SESSION['id_user'];

if (isset($_POST['oldPassword']) and isset($_POST['newPassword']) and isset($_POST['confirmedPassword']))
{
  $conn = pg_connect("host=".DB_SERVER." port=5432 dbname=".DB_DATABASE." user=".DB_USERNAME." password=".DB_PASSWORD);

  if (!$conn) {
    echo "An error occurred.\n";
    exit;
  }

  $oldPassword = $_POST['oldPassword'];
  $newPassword = $_POST['newPassword'];
  $confirmedPassword = $_POST['confirmedPassword'];

  $result = pg_query($conn, "SELECT * FROM password WHERE id_user='$id_user'");
  if (!$result) {
    echo "An error occurred.\n";
    exit;
  }

  $row = pg_fetch_row($result);
  $password_hash = hash('sha256', $newPassword);
  $old_password_hash = hash('sha256', $oldPassword);

  if ($newPassword != $confirmedPassword){
    echo "Password non uguali.\n";
    exit;
  }

  echo $id_user;
  echo "<br />\n";
  echo $row[1];
  echo "<br />\n";
  echo $old_password_hash;

  if ($old_password_hash != $row[1]){
    echo "Password vecchia errata.\n";
    exit;
  }

  $insert = pg_query($conn, "UPDATE password SET password = '$password_hash' WHERE id_user = '$id_user'");

  header("Location: personalPage.php");
}
else{
  echo "NOPE";
}

 ?>
