<?php

  include('connect.php');
  include('validate.php');

  if(isset($_GET['updateUser']))
  {
    // Set local variables equal to URL data
    $editUserID = $_GET['id'];
    $editFirstName = $_GET['firstName'];
    $editLastName = $_GET['lastName'];
    $editStreet = $_GET['street'];
    $editCity = $_GET['city'];
    $editState = $_GET['state'];
    $editZip = $_GET['zip'];

    // Escape all data
    $editUserID = mysqli_real_escape_string($conn, $editUserID);
    $editFirstName = mysqli_real_escape_string($conn, $editFirstName);
    $editLastName = mysqli_real_escape_string($conn, $editLastName);
    $editStreet = mysqli_real_escape_string($conn, $editStreet);
    $editCity = mysqli_real_escape_string($conn, $editCity);
    $editState = mysqli_real_escape_string($conn, $editState);
    $editZip = mysqli_real_escape_string($conn, $editZip);

    if(!isValid($editState, $editZip))
    {
      echo "<p class=\"error\">Form not submitted, see errors </p>";
      if(!stateValid($editState))
      {
        echo "<p class=\"error\">The state must be 2 characters</p>";
      }
      if(!zipValid($editZip))
      {
        echo "<p class=\"error\">The zip code must contain 5 numbers and must be greater than 0 </p>";
      }
    }
    else
    {

      // Structure query
      $sqlUpdate = "UPDATE users SET firstName='{$editFirstName}', lastName='{$editLastName}', street='{$editStreet}', city='{$editCity}', state='{$editState}', zip='{$editZip}' WHERE userID='{$editUserID}'";

      // Execute query
      $resultUpdate = mysqli_query($conn, $sqlUpdate);

      // Test if query was successful
      if($resultUpdate)
      {
        echo "<p class=\"successMessage\">Update successful </p>";
      }
      else
      {
        die("<p class=\"error\">Database update was unsuccessful</p>");
      }

    }
  }

?>
