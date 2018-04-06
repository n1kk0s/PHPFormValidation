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
      echo "Form not submitted, see errors <br>";
      if(!stateValid($editState))
      {
        echo "The state must be 2 characters <br>";
      }
      if(!zipValid($editZip))
      {
        echo "The zip code must contain 5 numbers and must be greater than 0 <br>";
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
        echo "Update successful <br>";
      }
      else
      {
        die("Database update was unsuccessful");
      }

    }
  }

?>
