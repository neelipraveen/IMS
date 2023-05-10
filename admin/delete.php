<?php     
 if (isset($_GET['class_id'])) {  
      $id = $_GET['class_id'];  
      $query = "DELETE FROM `classes` WHERE id = '$id'";  
      $run = mysqli_query($conn,$query);  
      if ($run) {  
           header('location:classes.php');  
      }else{  
           echo "Error: ".mysqli_error($db_conn);  
      }  
 }  
 ?> 