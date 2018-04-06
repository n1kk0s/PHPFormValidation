<!DOCTYPE html>
<html>
<head>
  <title>PHP Form</title>
  <link rel='stylesheet' type='text/css' href='styles.css'>
</head>
<body>

  <div class='heading'>
    <h1>PHP Form</h1>
    <h4>by Nick Weld</h4>
  </div>

  <div class='userSelectDiv'>
    <h2>Users</h2>

    <?php
      include('deleteUser.php');
      include('editUser.php');
      include('connect.php');
      include('addUser.php');

      $sql = "SELECT userID, firstName, lastName FROM users";
      $result = mysqli_query($conn, $sql);

    ?>

     <!-- Form for selecting a user -->
    <form method='get'>
      <select name='id'>
        <?php while($row = $result->fetch_assoc()) { ?>

        <option value='<?php echo $row['userID']?>'><?php echo $row['firstName'] . " " . $row['lastName'] ?></option>

        <?php } ?>
      </select><br>
      <input class="button" id="selectUser" type='submit' name='userSelect' value='Submit'>
    </form>
    <p class="instructions">
      To use this application, use the drop-down box above and click select
      to view the data of that user.<br>
      From there, you can change the data for that user, and click update to
      update the information for that user in the database. You can also choose to delete the user from the database using the delete button.<br>
      Before making a selection, you can also add a user by entering information into all of the fields that are present (besides the User ID field) and click add user to add the information to the database.<br>
      If you have already selected a user from the drop-down, you can use the add new user button to clear the fields and allow for you to enter your data.
    </p>
  </div>

  <div class='detailsDiv'>

    <h2>User Details</h2>

    <?php
      if(isset($_GET['userSelect'])) { //If form was submitted, get the id and assign data to variables
        $id = $_GET['id'];
        $sql = "SELECT userID, firstName, lastName, street, city, state, zip FROM users WHERE userID=". $id."";
        $result = mysqli_query($conn, $sql);
        $data = $result->fetch_assoc();
        $userID=$data['userID'];
        $firstName=$data['firstName'];
        $lastName=$data['lastName'];
        $street=$data['street'];
        $city=$data['city'];
        $state=$data['state'];
        $zip=$data['zip'];

      }
      else { // If form wasn't submitted, set data to empty strings to avoid null errors
        $userID="";
        $firstName="";
        $lastName="";
        $street="";
        $city="";
        $state="";
        $zip="";
      }
    ?>

<!-- Assign values from above to the associated input fields -->
    <form method='get' id="dataForm">

      UserID (leave blank): </br>
      <input class="textField" type='text' name='id' value='<?php echo $userID; ?>' readonly></br></br>
      First Name:<br>
      <input class="textField" type='text' name='firstName' value='<?php echo $firstName; ?>' required><br></br>
      Last Name:<br>
      <input class="textField" type='text' name='lastName' value='<?php echo $lastName; ?>' required><br></br>
      Street:<br>
      <input class="textField" type='text' name='street' value='<?php echo $street; ?>' required><br></br>
      City:<br>
      <input class="textField" type='text' name='city' value='<?php echo $city; ?>' required><br></br>
      State:<br>
      <input class="textField" id='state' type='text' name='state' value='<?php echo $state; ?>' required><br></br>
      Zip:<br>
      <input class="textField" id='zip' type='text' name='zip' value='<?php echo $zip; ?>' required><br></br>

      <?php //Shows Add User button only when a user hasn't been selected
        if(isset($_GET['userSelect']))
        {
          echo "<input class=\"button\" id=\"updateUser\" type=\"submit\" name=\"updateUser\" value=\"Update\">";
          echo "<input class=\"button\" id=\"deleteUser\" type=\"submit\" name=\"deleteUser\" value=\"Delete\">";
          echo "<a class=\"button\" id=\"addLink\" href=\"index.php\" title=\"Add New User\" target=\"\">Add New User</a>";
        } else {
          echo "<input class=\"button\" id=\"addUser\" type=\"submit\" name=\"addUser\" value=\"Add User\">";
        }
      ?>

    </form>

  </div>

</body>
</html>
