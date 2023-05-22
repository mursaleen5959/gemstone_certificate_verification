<?php
require_once('conn.php');
if(isset($_SESSION['admin_login']))
{}
else{
  echo "<script>window.location.href='index.php';</script>";
}
if (isset($_POST['save'])) {
  // Retrieve form data
  $ref_id = $_POST['id'];
  $origin = $_POST['origin'];
  $bead = $_POST['bead'];
  $colour = $_POST['colour'];
  $shape = $_POST['shape'];
  $size = $_POST['size'];
  $weight = $_POST['weight'];
  $real_faces = $_POST['real_faces'];
  $artificial = $_POST['artificial'];
  $test = $_POST['test'];
  $comment = $_POST['comment'];
  $margin = $_POST['margin'];

  $targetDir = "uploads/"; // Directory where the uploaded file will be stored
  $targetFile = $targetDir . basename($_FILES["img"]["name"]); // Path of the uploaded file

  // Check if the file is a valid image
  $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
  $validExtensions = array("jpg", "jpeg", "png", "gif");
  if (in_array($imageFileType, $validExtensions)) {
      // Check if the ref_id already exists in the database
      $stmt = $conn->prepare("SELECT ref_id FROM certificates WHERE ref_id = ?");
      $stmt->bind_param("s", $ref_id);
      $stmt->execute();
      $stmt->store_result();
      if ($stmt->num_rows > 0) {
          echo "<script>alert('Error: REF-ID already exists. Please use different ID');</script>";
          $stmt->close();
      } else {
          // Attempt to move the uploaded file to the specified directory
          if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile)) {
              // Insert form data into the certificates table
              $stmt = $conn->prepare("INSERT INTO certificates (ref_id, img, origin, bead, colour, shape, size, `weight`, real_faces, artificial, test, comment, margin) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
              $stmt->bind_param("sssssssssssss", $ref_id, $targetFile, $origin, $bead, $colour, $shape, $size, $weight, $real_faces, $artificial, $test, $comment, $margin);

              if ($stmt->execute()) {
                  // Data inserted successfully
                  echo "<script>alert('Information saved successfully.');</script>";
              } else {
                  // Error occurred while inserting data
                  echo "Error: " . $stmt->error;
              }

              $stmt->close();
          } else {
              echo "Error uploading image.";
          }
      }
  } else {
      echo "Invalid image file. Only JPG, JPEG, PNG, and GIF files are allowed.";
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
    textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #dee2e6;
      border-radius: 4px;
      transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
      font-size: 16px;
      color: #333333;
    }

    input[type="text"]:focus,
    textarea:focus {
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
    <h2>Enter Certificate Information</h2>
    <form method="post" action="" enctype="multipart/form-data">
      <div class="form-group">
        <label for="id">ID:</label>
        <input type="text" id="id" name="id" placeholder="REF-08823432103RTC" required>
      </div>

      <div class="form-group">
        <label for="img">Image:</label>
        <input type="file" class="form-control" id="img" name="img" required>
      </div>
      
      <div class="form-group">
        <label for="origin">Origin:</label>
        <input type="text" id="origin" name="origin" placeholder="Enter the origin" required>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="bead">Bead:</label>
            <input type="text" id="bead" name="bead" placeholder="Enter the bead" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="colour">Colour:</label>
            <input type="text" id="colour" name="colour" placeholder="Enter the colour" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="shape">Shape:</label>
            <input type="text" id="shape" name="shape" placeholder="Enter the shape" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="size">Size:</label>
            <input type="text" id="size" name="size" placeholder="Enter the size" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="weight">Weight:</label>
            <input type="text" id="weight" name="weight" placeholder="Enter the weight" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="real-faces">Real Faces:</label>
            <input type="text" id="real-faces" name="real_faces" placeholder="Enter the real faces" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="artificial">Artificial:</label>
            <input type="text" id="artificial" name="artificial" placeholder="Enter the artificial" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="test">Test:</label>
            <input type="text" id="test" name="test" placeholder="Enter the test" required>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="comment">Comment:</label>
            <input type="text" id="comment" name="comment" placeholder="Enter the comment" required>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="margin">Margin:</label>
            <input type="text" id="margin" name="margin" placeholder="Enter the margin" required>
          </div>
        </div>
      </div>
      <button type="submit" name="save" class="btn-submit">Save</button>
    </form>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
