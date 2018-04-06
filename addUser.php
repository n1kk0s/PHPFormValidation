<?php

  if(isset($_GET['addUser']))
  {
    $addFirstName = $_GET['firstName'];
    $addLastName = $_GET['lastName'];
    $addStreet = $_GET['street'];
    $addCity = $_GET['city'];
    $addState = $_GET['state'];
    $addZip = $_GET['zip'];

    // Escape all data
    $addFirstName = mysqli_real_escape_string($conn, $addFirstName);
    $addLastName = mysqli_real_escape_string($conn, $addLastName);
    $addStreet = mysqli_real_escape_string($conn, $addStreet);
    $addCity = mysqli_real_escape_string($conn, $addCity);
    $addState = mysqli_real_escape_string($conn, $addState);
    $addZip = mysqli_real_escape_string($conn, $addZip);

    // Validate form fields for State and Zip (the empty fields are handled by HTML)
    if(!isValid($addState, $addZip))
    {
      echo "<p class=\"error\">Form not submitted, see errors </p>";
      if(!stateValid($addState))
      {
        echo "<p class=\"error\">The state must be 2 characters </p>";
      }
      if(!zipValid($addZip))
      {
        echo "<p class=\"error\">The zip code must contain 5 numbers and must be greater than 0 </p>";
      }
    }
    else
    {
      // Prepare add query
      $sqlAdd = "INSERT INTO users (firstName, lastName, street, city, state, zip) VALUES ('{$addFirstName}', '{$addLastName}', '{$addStreet}', '{$addCity}', '{$addState}', '{$addZip}')";

      // Execute add query
      $resultAdd = mysqli_query($conn, $sqlAdd);

      // Check if add was successful
      if($resultAdd) {
        echo "<p class=\"successMessage\">Add successful </p>";
      } else {
        die("<p class=\"error\">Database insert was unsuccessful</p>");
      }

    }
  }

?>
