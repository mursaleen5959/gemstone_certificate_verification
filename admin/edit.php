<?php
require_once('conn.php');
if(isset($_SESSION['admin_login']))
{}
else{
  echo "<script>window.location.href='index.php';</script>";
}
// Check if the ID parameter is present in the URL
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Retrieve the certificate information from the database
  $stmt = $conn->prepare("SELECT * FROM certificates WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $certificate = $result->fetch_assoc();
  $stmt->close();

  if (!$certificate) {
    // Certificate not found, handle the error accordingly
    echo "Certificate not found.";
    exit;
  }
} else {
  // ID parameter is missing, handle the error accordingly
  echo "ID parameter is missing.";
  exit;
}

// Check if the form is submitted
if (isset($_POST['update'])) {
  // Retrieve the updated form data
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

  // Update the certificate information in the database
  $stmt = $conn->prepare("UPDATE certificates SET ref_id = ?, origin = ?, bead = ?, colour = ?, shape = ?, size = ?, `weight` = ?, real_faces = ?, artificial = ?, test = ?, comment = ?, margin = ? WHERE id = ?");
  $stmt->bind_param("ssssssssssssi", $ref_id, $origin, $bead, $colour, $shape, $size, $weight, $real_faces, $artificial, $test, $comment, $margin, $id);

  if ($stmt->execute()) {
    // Certificate updated successfully
    echo "<script>alert('Certificate updated successfully.');</script>";
  } else {
    // Error occurred while updating the certificate
    echo "Error: " . $stmt->error;
  }

  $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Certificate</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="nav.css">
  <style>
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

    .form-label {
      font-weight: bold;
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
  <?php include('nav.php'); ?>

  <div class="container">
    <h2>Edit Certificate</h2>
    <form method="POST">
      <div class="mb-3">
        <label for="id" class="form-label">Reference ID:</label>
        <input type="text" class="form-control" id="id" name="id" value="<?php echo $certificate['ref_id']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="origin" class="form-label">Origin:</label>
        <input type="text" class="form-control" id="origin" name="origin" value="<?php echo $certificate['origin']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="bead" class="form-label">Bead:</label>
        <input type="text" class="form-control" id="bead" name="bead" value="<?php echo $certificate['bead']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="colour" class="form-label">Colour:</label>
        <input type="text" class="form-control" id="colour" name="colour" value="<?php echo $certificate['colour']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="shape" class="form-label">Shape:</label>
        <input type="text" class="form-control" id="shape" name="shape" value="<?php echo $certificate['shape']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="size" class="form-label">Size:</label>
        <input type="text" class="form-control" id="size" name="size" value="<?php echo $certificate['size']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="weight" class="form-label">Weight:</label>
        <input type="text" class="form-control" id="weight" name="weight" value="<?php echo $certificate['weight']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="real_faces" class="form-label">Real Faces:</label>
        <input type="text" class="form-control" id="real_faces" name="real_faces" value="<?php echo $certificate['real_faces']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="artificial" class="form-label">Artificial:</label>
        <input type="text" class="form-control" id="artificial" name="artificial" value="<?php echo $certificate['artificial']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="test" class="form-label">Test:</label>
        <input type="text" class="form-control" id="test" name="test" value="<?php echo $certificate['test']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="comment" class="form-label">Comment:</label>
        <textarea class="form-control" id="comment" name="comment" required><?php echo $certificate['comment']; ?></textarea>
      </div>
      <div class="mb-3">
        <label for="margin" class="form-label">Margin:</label>
        <input type="text" class="form-control" id="margin" name="margin" value="<?php echo $certificate['margin']; ?>" required>
      </div>
      <div class="text-center">
        <button type="submit" class="btn-submit mt-5" name="update">Update</button>
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
