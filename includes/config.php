<?php

  $db_conn = mysqli_connect('localhost', 'root', '', 'ims_project');

  if (!$db_conn) {

    echo 'Connection failed';
    exit;
    
  }
  //session_start();
  if(empty($_SESSION) || isset($_SESSION['login']))
  {
    session_start(); 
  }
   
  include('functions.php');
?>