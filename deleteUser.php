<?php
  include('connect.php');

  if(isset($_GET['deleteUser']))
  {
    $idDelete = $_GET['id']; //NEED TO GET THE ID IT'S NOT BEING SENT CURRENTLY!!!

    $sqlDelete = "DELETE FROM users WHERE userID= {$idDelete}";
    $resultDelete = mysqli_query($conn, $sqlDelete);

    if($resultDelete)
    {
      echo "Deletion successful <br>";
    } else {
      die("Database deletion was unsuccessful");
    }
  }
?>
