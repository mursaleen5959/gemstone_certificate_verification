<?php
require_once('conn.php');
if (isset($_SESSION['admin_login'])) {
} else {
  echo "<script>window.location.href='index.php';</script>";
}
// Fetch all data from the certificates table
$stmt = $conn->prepare("SELECT * FROM certificates");
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Certificates</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  <link rel="stylesheet" href="nav.css">
</head>

<body>
  <?php
  require_once('nav.php');
  ?>
  <div class="container" style="margin-top: 20px;">
    <div class="row">
      <div class="col-sm-12">
        <table id="example" class="table table-striped" style="width:100%">
          <thead>
            <tr>
              <th>REF-ID</th>
              <th>Img</th>
              <th>Origin</th>
              <th>Bead</th>
              <th>Colour</th>
              <th>Shape</th>
              <th>Size</th>
              <th>Weight</th>
              <th>Real Faces</th>
              <th>Artificial</th>
              <th>Test</th>
              <th>Comment</th>
              <th>Margin</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            // Check if any data is retrieved
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['ref_id'] . "</td>";
                echo "<td><img src='" . $row['img'] . "' alt='Certificate Image' style='max-width: 80px; max-height: 80px;'></td>";
                echo "<td>" . $row['origin'] . "</td>";
                echo "<td>" . $row['bead'] . "</td>";
                echo "<td>" . $row['colour'] . "</td>";
                echo "<td>" . $row['shape'] . "</td>";
                echo "<td>" . $row['size'] . "</td>";
                echo "<td>" . $row['weight'] . "</td>";
                echo "<td>" . $row['real_faces'] . "</td>";
                echo "<td>" . $row['artificial'] . "</td>";
                echo "<td>" . $row['test'] . "</td>";
                echo "<td>" . $row['comment'] . "</td>";
                echo "<td>" . $row['margin'] . "</td>";
                echo "<td>";
                echo "<div class='btn-group btn-group-sm' role='group'>";
                echo "<a href='edit.php?id=" . $row['id'] . "' class='btn btn-primary'><i class='fas fa-edit'></i></a>";
                echo "<button class='btn btn-danger delete-btn ms-2' data-id='" . $row['id'] . "'><i class='fas fa-trash'></i></button>";
                echo "<a href='preview.php?id=" . $row['ref_id'] . "' class='btn btn-success ms-2'><i class='fas fa-eye'></i></a>";
                echo "</div>";
                echo "</td>";
                echo "</tr>";
              }
            }
            ?>
          </tbody>
          <tfoot>
            <tr>
              <th>REF-ID</th>
              <th>Img</th>
              <th>Origin</th>
              <th>Bead</th>
              <th>Colour</th>
              <th>Shape</th>
              <th>Size</th>
              <th>Weight</th>
              <th>Real Faces</th>
              <th>Artificial</th>
              <th>Test</th>
              <th>Comment</th>
              <th>Margin</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>

  </div>
  <script>
    $(document).ready(function() {
      $('#example').DataTable();
    });
  </script>
  <script>
    $(document).ready(function() {
      // Function to handle delete button click
      $('.delete-btn').click(function() {
        if (confirm("Are you sure you want to delete this record?")) {
          var certificateId = $(this).data('id');

          // Send AJAX request to delete the record
          $.ajax({
            url: 'delete.php',
            type: 'POST',
            data: {
              id: certificateId
            },
            success: function(response) {
              // Refresh the page or update the table if necessary
              location.reload();
            },
            error: function(xhr, status, error) {
              console.error(xhr.responseText);
            }
          });
        }
      });
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>