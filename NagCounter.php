<!DOCTYPE html>
<html>
    <head>
        <title>Nag Counter</title>
    </head>
    <body>
        <h3>Jennifer Reisinger</h3>
        <h3>Assignment 9-3</h3>
        <h3>Nag Counter</h3><hr />
        <h2>New visitors, please register!</h2>

<body>
  
  <?php
    // Check if the user has submitted the form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // Store user input in cookies
      $name = $_POST['name'];
      $email = $_POST['email'];
      
      // Set cookies for name and email that are valid for 30 days
      setcookie("username", $name, time() + (86400 * 30), "/");
      setcookie("useremail", $email, time() + (86400 * 30), "/"); 
      
      // Delete the nag counter cookie
      setcookie("nag_counter", "", time() - 3600, "/");
      
      echo "<p>Thank you for registering, $name! Your information has been saved.</p>";
    }
    
    // Check if the nag counter cookie exists and its value
    if(isset($_COOKIE['nag_counter'])) {
      $counter = $_COOKIE['nag_counter'];
      $counter++;

      // Display nag message every fifth visit
      if ($counter % 5 == 0) {
        echo "<p>Please register to enjoy full access!</p>";
      }
    } else {
      // If the nag counter cookie doesn't exist, create it
      $counter = 1;
    }

    // Set the updated counter value in the cookie
    setcookie("nag_counter", $counter, time() + (86400 * 30), "/"); 
    
  ?>

  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required><br><br>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>
    
    <input type="submit" value="Register">
  </form>
  
  <?php
    // Display stored name and email
    if(isset($_COOKIE['username']) && isset($_COOKIE['useremail'])) {
      $storedName = $_COOKIE['username'];
      $storedEmail = $_COOKIE['useremail'];
      
      echo "<h2>Stored Information:</h2>";
      echo "<p>Name: $storedName</p>";
      echo "<p>Email: $storedEmail</p>";
    }
  ?>
</body>
</html>
