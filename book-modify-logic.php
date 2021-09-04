
<?php
include "../inc/dbinfo.inc";

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();

$id_user = $_SESSION['id_user'];

$title = $_POST['Title'];
$id_book = $_POST['id_book'];

if (isset($_POST['Title']))
{
  $conn = pg_connect("host=".DB_SERVER." port=5432 dbname=".DB_DATABASE." user=".DB_USERNAME." password=".DB_PASSWORD);

  if (!$conn) {
    echo "An error occurred.\n";
    exit;
  }

  $insert = pg_query($conn, "UPDATE books SET title = '$title' WHERE id_book = '$id_book'");

  header("Location: personalPage.php");
}
else{
  echo "NOPE";
}

 ?>
