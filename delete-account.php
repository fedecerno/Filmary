<?php
include "../inc/dbinfo.inc";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
  </head>
  <body>
    <?php

    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);

    session_start();
    $id_user = $_SESSION['id_user'];

    ?>

    <?php if (isset($_POST['error']) and $_POST['error'] == 'error') { ?>
      <h1>Incorrect password</h1>
    <?php } ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="./index.php">Filmary</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="./about-us.php">About Us</a>
            </li>
          </ul>
        </div>
        <a class="btn btn-primary" href="./personal-area.php" role="button">Personal Area</a>
      </div>
    </nav>

    <form method='post' action='./delete-account-logic.php'>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name='password' required>
      </div>
      <button type="submit" class="btn btn-primary">Delete Account</button>
    </form>

    <a class="btn btn-primary" href="./personalPage.php" role="button">Cancel</a>


  </body>
</html>
