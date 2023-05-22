<?php
require_once('conn.php');
if(isset($_SESSION['admin_login']))
{}
else{
  echo "<script>window.location.href='index.php';</script>";
}
if (isset($_POST['update'])) {
  // Retrieve form data
  $username = $_POST['username'];
  $psw      = $_POST['psw'];
  $cnf_psw  = $_POST['cnf_psw'];
  if($psw!='' AND $cnf_psw!='')
  {
      if($psw==$cnf_psw)
      {
          $psw=md5($psw);
          $updateQuery = "UPDATE admin SET";
          $params = array();
        
            if (!empty($username)) {
                $updateQuery .= " name = ?,";
                $params[] = $username;
            }
        
            if (!empty($password)) {
                $updateQuery .= " password = ?,";
                $params[] = $psw;
            }
        
            // Remove trailing comma from the query
            $updateQuery = rtrim($updateQuery, ",");
        
            if (!empty($params)) {
                $updateQuery .= " WHERE id = 1"; // Assuming the admin record has ID 1
                $stmt = $conn->prepare($updateQuery);
                $stmt->bind_param(str_repeat("s", count($params)), ...$params);
        
                if ($stmt->execute()) {
                    // Update successful
                    $message="Information updated successfully.";
                    unset($_SESSION['admin_login']);
                } else {
                    // Error occurred while updating
                    $error="Error updating admin information: " . $stmt->error;
                }
        
                $stmt->close();
            } else {
            }
      }
      else{
          echo "<script>alert('Password and Confirm password must be same. Please try again');</script>";
      }
  }
  
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Certificate Information</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="nav.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 50px;
      background-color: #ffffff;
      border: 1px solid #dee2e6;
      border-radius: 5px;
      margin-top: 50px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 30px;
      font-size: 28px;
      color: #333333;
    }

    .form-group {
      margin-bottom: 30px;
    }

    label {
      display: block;
      width: 100%;
      font-weight: bold;
      color: #333333;
    }

    input[type="file"]{
      padding: 10px;
      padding-left: 20px;
    }

    input[type="text"],
    textarea,input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #dee2e6;
      border-radius: 4px;
      transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
      font-size: 16px;
      color: #333333;
    }

    input[type="text"]:focus,
    textarea:focus,input[type="password"]:focus {
      outline: none;
      border-color: #80bdff;
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .btn-submit {
      display: block;
      width: 100%;
      padding: 20px;
      border-radius: 4px;
      background-color: burlywood !important;
      color: #ffffff;
      font-weight: bold;
      border: none;
      cursor: pointer;
      transition: background 0.3s ease;
      font-size: 16px;
    }

    .btn-submit:hover {
      background-color: rgb(237, 181, 108) !important;
    }
  </style>
</head>
<body>
    <?php
    require_once('nav.php');
    ?>
  <div class="container">
    <h2>Edit Information</h2>
    <?php
    if(isset($message))
    {
        echo '<p class="text-center mb-3" style="color:green">'.$message.'</p>';
    }
    else if(isset($error))
    {
        echo '<p class="text-center mb-3" style="color:red">'.$error.'</p>';
    }
    ?>
    <form method="post" action="">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" placeholder="Enter the username" required>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="psw">Password:</label>
            <input type="password" id="psw" name="psw" placeholder="Enter the password" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="cnf_psw">Confirm Password:</label>
            <input type="password" id="cnf_psw" name="cnf_psw" placeholder="Confirm password" required>
          </div>
        </div>
      </div>
      <button type="submit" name="update" class="btn-submit">Update</button>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
