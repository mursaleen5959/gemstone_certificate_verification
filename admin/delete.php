<?php
require_once('conn.php');
if(isset($_SESSION['admin_login']))
{}
else{
  echo "<script>window.location.href='index.php';</script>";
}
if (isset($_POST['id'])) {
  $certificateId = $_POST['id'];

  // Delete the record from the database
  $stmt = $conn->prepare("DELETE FROM certificates WHERE id = ?");
  $stmt->bind_param("i", $certificateId);

  if ($stmt->execute()) {
    echo "Record deleted successfully.";
  } else {
    echo "Error deleting record: " . $stmt->error;
  }

  $stmt->close();
}
?>
