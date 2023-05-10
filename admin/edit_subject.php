<?php
include('../includes/config.php');

if(isset($_POST['submit']))
{
  $subject_id = isset($_POST['subject_id'])?$_POST['subject_id']:'';
  $title = isset($_POST['title'])?$_POST['title']:'';
  $from = isset($_POST['from'])?$_POST['from']:'';
  $to = isset($_POST['to'])?$_POST['to']:'';

  mysqli_query($db_conn, "UPDATE `posts` SET `title`='$title' WHERE `id`='$subject_id'");
  mysqli_query($db_conn, "UPDATE `metadata` SET `meta_value`='$from' WHERE `meta_key`='from' AND `item_id`='$subject_id'");
  mysqli_query($db_conn, "UPDATE `metadata` SET `meta_value`='$to' WHERE `meta_key`='to' AND `item_id`='$subject_id'");

  $_SESSION['success_msg'] = 'Subject updated successfully';
  header('Location: subjects.php');
  exit;
}

if(isset($_GET['subject_id']))
{
  $subject_id = $_GET['subject_id'];

  $subject_query = mysqli_query($db_conn, "SELECT * FROM `posts` WHERE `id`='$subject_id'");
  $subject_data = mysqli_fetch_assoc($subject_query);
  $title = $subject_data['title'];

  $from_query = mysqli_query($db_conn, "SELECT `meta_value` FROM `metadata` WHERE `meta_key`='from' AND `item_id`='$subject_id'");
  $from_data = mysqli_fetch_assoc($from_query);
  $from = $from_data['meta_value'];

  $to_query = mysqli_query($db_conn, "SELECT `meta_value` FROM `metadata` WHERE `meta_key`='to' AND `item_id`='$subject_id'");
  $to_data = mysqli_fetch_assoc($to_query);
  $to = $to_data['meta_value'];
}
else
{
  header('Location: subjects.php');
  exit;
}
?>

<?php include('header.php') ?>
<?php include('sidebar.php') ?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit Subject </h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Admin</a></li>
          <li class="breadcrumb-item"><a href="#">Subjects</a></li>
          <li class="breadcrumb-item active">Edit Subject</li>
        </ol>
      </div><!-- /.col -->
      <?php
       
        if(isset($_SESSION['success_msg']))
        {?>
          <div class="col-12">
            <small class="text-success" style="font-size:16px"><?=$_SESSION['success_msg']?></small>
          </div>
        <?php 
          unset($_SESSION['success_msg']);
        }
      ?>
   
