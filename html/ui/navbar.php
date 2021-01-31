<?php
include_once 'header.php';

@ob_start();
session_start();

$uniqueUser = md5(
  $_SERVER['REMOTE_ADDR'] .
  $_SERVER['HTTP_USER_AGENT']
);
$_SESSION["unique"] = $uniqueUser;
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <a class="navbar-brand" href="../">
    <img class="logo" src="../assets/img/logo.png" alt="">
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav navbar-center nav-text">
      <li class="nav-item active">
        <a class="nav-link mx-3" href="../">Read Secrets <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link mx-3" href="../main/tellsecret.php">Tell a secret</a>
      </li>
    </ul>

  </div>
</nav>
