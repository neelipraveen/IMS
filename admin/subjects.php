<?php include('../includes/config.php') ?>
<?php
if(isset($_POST['submit']))
{
  $title = isset($_POST['title'])?$_POST['title']:'';
  $from = isset($_POST['from'])?$_POST['from']:'';
  $to = isset($_POST['to'])?$_POST['to']:'';
  $status = 'publish';
  $type = 'subject';
  $date_add = date('Y-m-d g:i:s');

  $query = mysqli_query($db_conn, "INSERT INTO `posts` (`title`,`status`,`publish_date`,`type`) VALUES ('$title','$status','$date_add','$type') ");

  if($query)
  {
    $item_id = mysqli_insert_id($db_conn);
  }

  mysqli_query($db_conn, "INSERT INTO `metadata` (`meta_key`,`meta_value`,`item_id`) VALUES ('from','$from','$item_id') ");
  mysqli_query($db_conn, "INSERT INTO `metadata` (`meta_key`,`meta_value`,`item_id`) VALUES ('to','$to','$item_id') ");

  header('Location: subjects.php');
}
?>

<?php     
if(isset($_GET['delete'])){
  $subject_id = $_GET['delete'];
  mysqli_query($db_conn, "DELETE FROM posts WHERE id = '$subject_id'") or die('DB error');
  header('Location: subjects.php'); exit;
} 
 ?>

<?php include('header.php') ?>
<?php include('sidebar.php') ?>

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Manage Subjects </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Admin</a></li>
              <li class="breadcrumb-item active">Subjects</li>
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
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php
        if (isset($_REQUEST['action'])) { ?>
        <!-- Info boxes -->
        <!-- <div class="card">
          <div class="card-header py-2">
            <h3 class="card-title">
              Add New Course
            </h3>
          </div>
          <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label for="name">Course Name</label>
                <input type="text" name="name" placeholder="Course Name" required class="form-control">
              </div>
              <div class="form-group">
                <label for="category">Course Category</label>
                <select name="category" id="category" class="form-control">
                  <option value="">Select Category</option>
                  <option value="web-design-and-development">Web Design & Development</option>
                  <option value="app-developement">App Development</option>
                </select>
              </div>
              <div class="form-group">
                <label for="duration">Course Duration</label>
                <input type="text" name="duration" id="duration" class="form-control" placeholder="Course Duration" required>
              </div>
              <div class="form-group">
                <input type="file" name="thumbnail" id="thumbnail" required>
              </div>
              <button name="submit" class="btn btn-success">
                Submit
              </button>
            </form>
          </div>
        </div> -->
        <!-- /.row -->
        <?php }else{?>
        <!-- Info boxes -->
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header py-2">
                        <h3 class="card-title">
                            Add New Subject
                        </h3>
                    </div>
                    <div class="card-body" >
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="class_id">Select Class</label>
                                <select require name="class_id" id="class_id" class="form-control">
                                    <option value="">-Select Class-</option>
                                    <?php
                                    $args = array(
                                      'type' => 'class',
                                      'status' => 'publish',
                                    );
                                    $classes = get_posts($args); 
                                    foreach ($classes as $key => $class) { ?>
                                    <option value="<?php echo $class->id ?>"><?php echo $class->title ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group" id="section-container" style="display:none">
                                <label for="section_id">Select Section</label>
                                <select require name="section_id" id="section_id" class="form-control">
                                    <option value="">-Select Section-</option>
                                </select>
                            </div>

                              <form action="" method="POST">
                                <div class="form-group">
                                  <label for="title">Subject Name</label>
                                  <input type="text" name="title" placeholder="EnterSubject Name" required class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header py-2">
                        <h3 class="card-title">
                        Subjects
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive bg-white">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $count = 1;
                                    $args = array(
                                      'type' => 'subject',
                                      'status' => 'publish',
                                    );
                                    $subjects = get_posts($args);
                                    foreach($subjects as $subject){?>
                                    <tr>
                                        <td><?=$count++?></td>
                                        <td><?=$subject->title?></td>
                                        <td><?=$subject->publish_date?></td>
                                        <td>
                                          <a href="edit_subject.php?id=<?= $subject->id ?>" class="btn btn-info btn-xs">Edit</a>
                                          <a href="?delete=<?=$subject->id?>" class="btn btn-danger btn-xs">Delete</a>
                                        </td>
                                    </tr>

                                    <?php } ?>

                                </toby>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
        <?php } ?>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
<?php include('footer.php') ?>