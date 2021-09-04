<?php

include "../inc/dbinfo.inc";

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();

if (isset($_POST['password']) and isset($_POST['email']))
{
  $conn = pg_connect("host=".DB_SERVER." port=5432 dbname=".DB_DATABASE." user=".DB_USERNAME." password=".DB_PASSWORD);

  if (!$conn) {
    echo "An error occurred.\n";
    exit;
  }

  $email = $_POST['email'];
  $password = $_POST['password'];

  $result = pg_query($conn, "SELECT * FROM password WHERE email='$email'");
  if (pg_num_rows($result) == 0) {
    echo '
    <form method="post" action="./index.php" id="error">
      <input type="hidden" name="error" value="error">
    </form>';
   }

  $row = pg_fetch_row($result);
  $password_hash = hash('sha256', $password);

  if ($password_hash == $row[1]){
    $_SESSION['id_user'] = $row[0];
    header("Location: personalPage.php");
    exit;
  }
  else{
    echo '
    <form method="post" action="./index.php" id="error">
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
