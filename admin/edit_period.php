<?php include('../includes/config.php') ?>

<?php
if(isset($_POST['submit'])) {
    $period_id = isset($_POST['id']) ? $_POST['id'] : '';
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $from = isset($_POST['from']) ? $_POST['from'] : '';
    $to = isset($_POST['to']) ? $_POST['to'] : '';

    $query = mysqli_query($db_conn, "UPDATE `posts` SET `title` = '$title' WHERE `id` = '$period_id'");

    if($query) {
        mysqli_query($db_conn, "UPDATE `metadata` SET `meta_value` = '$from' WHERE `item_id` = '$item_id' AND `meta_key` = 'from'");
        mysqli_query($db_conn, "UPDATE `metadata` SET `meta_value` = '$to' WHERE `item_id` = '$item_id' AND `meta_key` = 'to'");
    }
    header('Location: periods.php');
    exit;
}

if(isset($_GET['id'])) {
    $period_id = $_GET['id'];
    $period_query = mysqli_query($db_conn, "SELECT * FROM posts WHERE id='$period_id'");
    $period = mysqli_fetch_object($period_query);
  }
?>

<?php include('header.php') ?>
<?php include('sidebar.php') ?>

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Edit Period</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item"><a href="periods.php">Periods</a></li>
                        <li class="breadcrumb-item active">Edit Period</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Period Information</h3>
                        </div>
                        <form role="form" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" class="form-control" value="<?php echo $period->title; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="from">From</label>
                                    <input type="time" name="from" class="form-control" value="<?php echo $from; ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="to">To</label>
                                    <input type="time" name="to" class="form-control" value="<?php echo $to; ?>" required>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                            </form>
                            </div>
                            </div>
                            </div>
                            </div>
                            </section>
                            <!-- /.content -->

                            <?php include('footer.php') ?>
