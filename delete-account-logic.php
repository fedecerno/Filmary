<?php

include "../inc/dbinfo.inc";

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();
$id_user = $_SESSION['id_user'];

if (isset($_POST['password']))
{
  $conn = pg_connect("host=".DB_SERVER." port=5432 dbname=".DB_DATABASE." user=".DB_USERNAME." password=".DB_PASSWORD);

  if (!$conn) {
    echo "An error occurred.\n";
    exit;
  }

  $password = $_POST['password'];

  $result = pg_query($conn, "SELECT * FROM password WHERE id_user='$id_user'");

  $row = pg_fetch_row($result);
  $password_hash = hash('sha256', $password);

  if ($password_hash == $row[1]){
    $result = pg_query($conn, "DELETE FROM final WHERE id_user='$id_user'");
    $result = pg_query($conn, "DELETE FROM password WHERE id_user='$id_user'");
    $result = pg_query($conn, "DELETE FROM users WHERE id_user='$id_user'");
    session_abort();
    header("Location: index.php");
    exit;
  }
  else{
    echo '
    <form method="post" action="./delete-account.php" id="error">
      <input type="hidden" name="error" value="error">
    </form>';
   }
}
else{
  echo "NOPE";
}
#$email = $_POST['email'];
#$password = $_POST['password'];

#$conn = pg_connect("host=".DB_SERVER." port=5432 dbname=".DB_DATABASE." user=".DB_USERNAME." password=".DB_PASSWORD);

#$query = pg_query($conn, "SELECT * FROM users WHERE email=$email");

#echo "$query['password']";
 ?>

 <script type="text/javascript">
     document.getElementById('error').submit();
 </script>
