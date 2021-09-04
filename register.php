<?php

include "../inc/dbinfo.inc";

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if (isset($_POST['name']) and isset($_POST['surname']) and isset($_POST['birthday']) and isset($_POST['email']) and isset($_POST['password']))
{
  $conn = pg_connect("host=".DB_SERVER." port=5432 dbname=".DB_DATABASE." user=".DB_USERNAME." password=".DB_PASSWORD);

  if (!$conn) {
    echo "An error occurred.\n";
    exit;
  }

  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $birthday = $_POST['birthday'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  $query_email = pg_query($conn, "SELECT email FROM users WHERE email='$email'");

  if (pg_num_rows($query_email) >= 1) {
    echo '
    <form method="post" action="./registration.php" id="error">
      <input type="hidden" name="error" value="error">
    </form>';

  }

  else {

    $query_insert_users = pg_query($conn, "INSERT into users (name, surname, email) VALUES ('$name', '$surname', '$email')");
    $password_hash = hash('sha256', $password);
    $query_id_user = pg_query($conn, "SELECT id_user FROM users WHERE email='$email'");
    $row_id_user = pg_fetch_row($query_id_user);
    $id_user = $row_id_user[0];
    $query_insert_password = pg_query($conn, "INSERT into password (id_user, password, email) VALUES ('$id_user', '$password_hash', '$email')");

    header("Location: index.php");
    exit;
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
