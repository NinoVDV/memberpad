<?php
session_start();
include "includes/config.php";
include "includes/database.php";
include "view/head.php";

$action = isset($_GET['page'])?$_GET['page']:'home';

switch ($action) {
  case 'home':
  include "view/main.php";
  break;

  case 'login':
  include "view/otherNav.php";
  include "view/login.php";
  if(isset($_POST['login-submit'])){
    include "model/login_user.php";
  }
  break;

  case 'registreer':
  include "view/otherNav.php";
  include "view/regist.php";
  if(isset($_POST['regist-submit'])){
  include "model/add_user.php";
}
  break;

  case 'account':
  include "view/account.php";
  break;

  case 'logout':
  include "model/logout.php";
  break;

  case 'check':
  include "view/otherNav.php";
  include "view/loggedInCheck.php";
  break;
}
 ?>
