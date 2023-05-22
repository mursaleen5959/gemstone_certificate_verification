<?php
require_once('admin/conn.php');

function numberToWords($number) {
    $formatter = new NumberFormatter('en', NumberFormatter::SPELLOUT);
    return $formatter->format($number);
}


if (isset($_POST['search'])) {
  // Fetch data from the certificates table
  $stmt = $conn->prepare("SELECT * FROM certificates WHERE ref_id='{$_POST['id']}'");
  $stmt->execute();
  $result = $stmt->get_result();

  // Check if any data is retrieved
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $result_OK    = true;
        $ref_id       = $row['ref_id'];
        $barcode      = explode('-',$ref_id)[1]; 
        $img          = $row['img'];
        $origin       = $row['origin'];
        
        $bead         = $row['bead'];
        
        $words = explode(" ", $bead); // Split the string into an array of words
        $first_num = $words[0];
        $modifiedWords = array_slice($words, 1); // Remove the first word
        $modifiedString = implode(" ", $modifiedWords); // Convert the array back into a string
        //echo $modifiedString; // Output: "is a sample string"
        
        $colour       = $row['colour'];
        $shape        = $row['shape'];
        $size         = $row['size'];
        $weight       = $row['weight'];
        $real_faces   = $row['real_faces'];
        $artificial   = $row['artificial'];
        $test         = $row['test'];
        $comment      = $row['comment'];
        $margin       = $row['margin'];
    }
  } else {
    $error_var = "No record found !";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="user-nav.css">
  <link rel="stylesheet" href="user.css">

</head>

<body>
  <?php
  require_once('user-nav.php');

  if(isset($result_OK) && $result_OK == true)
  {
    ?>
    

    <div class="certificate-show" id="certificate-print-id">
      <div class="certificate-container">
        <div class="row head">
          <div class="col-sm-2">
            <img src="green.png" alt="" width="140px">
          </div>
          <div class="col-sm-10 pt-3">
            <p class="text-danger text-center fs-3 mb-1" style="font-weight: 800;">ORIENTAL HERITAGE RUDRAKSHA TESTING CENTER</p>
            <p class="text-danger text-center fs-4 mb-1" style="font-weight: 600;">The Name of Assurance of Satisfaction</p>
            <p class="text-center fs-5 mb-1" style="font-weight: 600;">Tal: Amb, Near Sharda Hotel, Mumbai-421304 Mob-9049435932</p>
          </div>
        </div>
        <div class="row body">
          <div class="col-sm-8">
            <div class="row">
              <div class="col-sm-6">
                <h5 class="fw-bold"><?= $ref_id ?></h5>
                <table class="table">
                  <tr>
                    <th>Origin</th>
                    <td><?= $origin ?></td>
                  </tr>
                  <tr>
                    <th>Bead</th>
                    <td><?= $bead ?></td>
                  </tr>
                  <tr>
                    <th>Colour</th>
                    <td><?= $colour ?></td>
                  </tr>
                  <tr>
                    <th>Shape</th>
                    <td><?= $shape ?></td>
                  </tr>
                  <tr>
                    <th>Size</th>
                    <td><?= $size ?></td>
                  </tr>
                  <tr>
                    <th>Weight</th>
                    <td><?= $weight ?></td>
                  </tr>
                  <tr>
                    <th>Real Faces</th>
                    <td><?= $real_faces ?></td>
                  </tr>
                  <tr>
                    <th>Artificial</th>
                    <td><?= $artificial ?></td>
                  </tr>
                  <tr>
                    <th>Test</th>
                    <td><?= $test ?></td>
                  </tr>
                  <tr>
                    <th>Comment</th>
                    <td><?= $comment ?></td>
                  </tr>
                  <tr>
                    <th>Margin</th>
                    <td><?= $margin ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-sm-6">
                <div class="barcode text-center">
                  <img src="https://barcode.tec-it.com/barcode.ashx?data=<?= $barcode ?>" alt="">
                </div>
                <div class="iso text-center">
                  <img src="iso.jpg?r=45" alt="" width="150px">
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <h6 class="fw-bold">Note-Weight may vary +- due to Air & other reason Specimen may differ if not sealed properly with certificate.</h5>
                    <h4 class="text-start" id="SecretFont">NATURAL <?=numberToWords($first_num)?> <?=$modifiedString?></h4>
                </div>
              </div>
            </div>
          </div>


          <div class="col-sm-4">
            <div class="parent-container" style="display: flex;flex-direction:column;height:100%">
              <div class="gem-img text-center d-flex" style="flex-grow:1;justify-content:center;align-self:center;align-items: center;">
                <img src="admin/<?= $img ?>" alt="" width="150px">
              </div>
              <div class="" style="align-self: flex-end;">
                <img src="Ramesh vats signature.jpg" alt="" width="250px">
                <h5 class="" id="stampFont">CERTIFIED GEMOLOGIST DDG(Jaipur) ADDG(Jodhpur) Indian Gemology Institue</h5>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

  <?php
  }
  ?>


  <div class="container">
    <div class="row">
      <div class="col-sm-2"></div>
      <div class="col-sm-8">
        <?php
        if (isset($error_var)) { ?>

          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> <?=$error_var?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        <?php
        }
        ?>

        <form method="post" action="">
          <div class="form-group">
            <label for="id">Enter ID to verify Certificate:</label>
            <input type="text" id="id" name="id" placeholder="REF-08823432103RTC" required>
          </div>

          <button type="submit" name="search" class="btn-submit">Search</button>
        </form>
      </div>
      <div class="col-sm-2"></div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>