<?php
require_once('conn.php');
if(isset($_SESSION['admin_login']))
{
    echo "<script>window.location.href='show_certificates.php';</script>";
}
if(isset($_POST['login']))
{
    // Get the form input values
    $enteredUsername = $_POST['uname'];
    $enteredPassword = md5($_POST['psw']);
    $stmt = $conn->prepare("SELECT * FROM `admin` WHERE `name` = ? AND password = ?");
    $stmt->bind_param("ss", $enteredUsername, $enteredPassword);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if the admin credentials exist in the database
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc(); // Fetch the row from the result set
        $_SESSION['username'] = $row['name'];
        // Admin login successful
        $_SESSION['admin_login']=true;
        echo "<script>window.location.href='add_certificate.php';</script>";
        // Perform any additional actions or redirect to the admin dashboard
    } else {
        // Invalid admin credentials
        $error=true;
    }
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .message {
      text-align: center;
      margin-top: 10px;
      font-weight: bold;
    }

    .error-message {
      color: red;
      margin-top: 10px;
    }

    .login-form {
      max-width: 500px; /* Adjust the maximum width */
      margin: 0 auto;
      padding: 30px; /* Increase the padding */
      background-color: #ffffff;
      border: 1px solid #dee2e6;
      border-radius: 5px;
      margin-top: 100px;
    }

    .login-form .form-control {
      border-radius: 2px;
      height: 50px; /* Increase the height */
    }

    .login-form .btn {
      border-radius: 2px;
      background-color: #007bff;
      color: #ffffff;
      height: 50px; /* Increase the height */
      font-size: 18px; /* Increase the font size */
    }

    .login-form .btn:hover {
      background-color: #0069d9;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="login-form">
      <h2 class="text-center">Admin Login</h2>
      <form method="post" action="">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="uname" placeholder="Enter username">
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="psw" placeholder="Enter password">
        </div>
        <div class="text-center">
          <button type="submit" name="login" class="btn btn-primary">Login</button>
        </div>
        <?php
        if(isset($error))
        {
            echo "<p class='message error-message'>Invalid username or password!</p>";
        }
        ?>
      </form>
    </div>
  </div>
</body>
</html>
