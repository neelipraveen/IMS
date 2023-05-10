<?php
include('../includes/config.php');

if(isset($_POST['submit'])) {
  $class_id = $_POST['class_id'];
  $title = $_POST['title'];
  $sections = implode(',',$_POST['section']);
  
  mysqli_query($db_conn, "UPDATE classes SET title='$title', section='$sections' WHERE id='$class_id'") or die('DB error');
  header('Location: classes.php'); exit;
}

if(isset($_GET['id'])) {
  $class_id = $_GET['id'];
  $class_query = mysqli_query($db_conn, "SELECT * FROM classes WHERE id='$class_id'");
  $class = mysqli_fetch_object($class_query);
}
?>

<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Edit Class</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="">Admin</a></li>
          <li class="breadcrumb-item"><a href="classes.php">Classes</a></li>
          <li class="breadcrumb-item active">Edit Class</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
        <form action="" method="POST">
          <input type="hidden" name="class_id" value="<?= $class->id ?>">
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" value="<?= $class->title ?>" placeholder="Title" required class="form-control">
          </div>
          <div class="form-group">
            <label for="title">Sections</label>
            <?php 
            $query = mysqli_query($db_conn,'SELECT * FROM sections');
            $count=1;
            while($sections = mysqli_fetch_object($query)) { ?>
            <div>
              <label for="<?=$count?>">
                <input type="checkbox" id="<?=$count?>" value="<?=$sections->id?>" name="section[]" placeholder="Section" <?php if (in_array($sections->id, explode(',', $class->section))) echo "checked"; ?>>
                <?=$sections->title?>
              </label>
            </div>
            <?php
            $count++;
            } ?>
          </div>
          <button name="submit" class="btn btn-success">
            Save Changes
          </button>
        </form>
      </div>
    </div>
  </div>
</section>
<!-- /.content -->

<?php include('footer.php'); ?>
